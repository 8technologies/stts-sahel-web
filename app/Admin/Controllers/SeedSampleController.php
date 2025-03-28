<?php

namespace App\Admin\Controllers;

use App\Models\Cooperative;
use App\Models\CooperativeMember;
use App\Models\LoadStock;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use \Encore\Admin\Facades\Admin;
use Encore\Admin\Auth\Database\Administrator;
use \App\Models\SeedLab;
use \App\Models\CropDeclaration;
use \App\Models\CropVariety;
use \App\Models\Crop;
use App\Models\OutGrower;
use \App\Models\SeedClass;
use \App\Models\Utils;
use \App\Models\Validation;
use Illuminate\Support\Facades\Log;

class SeedSampleController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected function title()
    {
        return trans('admin.form.Seed sample request');
    }


    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new SeedLab());
        $user = Admin::user();

        //filter by name
        $grid->filter(function ($filter) {
        // Remove the default id filter
        $filter->disableIdFilter();
        $filter->like('user_id', 'Applicant')->select(\App\Models\User::pluck('name', 'id'));
        
        });
        //disable action buttons appropriately
        Utils::disable_buttons('SeedLab', $grid);


        //disable batch and export actions
        Utils::disable_batch_actions($grid);

        //order of the table 
        $grid->model()->orderBy('id', 'desc');
       
       //function to show the loggedin user only what belongs to them
       Validation::showUserForms($grid);

        if ($user->inRoles(['commissioner','inspector','developer'])) {
            $grid->disableCreateButton();
        }
 
        $grid->column('sample_request_number', __('admin.form.Sample request number'));
         $grid->column('user_id', __('admin.form.Applicant'))
        ->display(function ($user_id) {
            return \App\Models\User::find($user_id)->name??'-';
        });
        $grid->column('load_stock_id', __('admin.form.Crop stock number'))->display(function ($load_stock_id) {
            return \App\Models\LoadStock::find($load_stock_id)->load_stock_number??'-';
        });
        $grid->column('sample_request_date', __('admin.form.Sample request date'));
        $grid->column('status', __('admin.form.Status'))->display(function ($status) {
            return \App\Models\Utils::tell_status($status) ?? '-';
        });
        $grid->column('applicant_remarks', __('admin.form.Applicant remarks'));

    
        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(SeedLab::findOrFail($id));
           //delete notification after viewing the form
           Utils::delete_notification('SeedLab', $id);

           //check if the user is the owner of the form
           $showable = Validation::checkUser('SeedLab', $id);
           if (!$showable) 
           {
               return(' <p class="alert alert-danger">You do not have rights to view this form. <a href="/seed-sample-requests"> Go Back </a></p> ');
           }


        $show->field('sample_request_number', __('admin.form.Sample request number'));
        $show->field('user_id', __('admin.form.Applicant'))->as(function ($user_id) {
            return \App\Models\User::find($user_id)->name;
        });
        $show->field('load_stock_id', __('admin.form.Load stock number'))->as(function ($load_stock_id) {
            return \App\Models\LoadStock::find($load_stock_id)->load_stock_number;
        });
        $show->field('quantity', __('admin.form.Sample size(kgs)'));
            
        $show->field('sample_request_date', __('admin.form.Sample request date'));
        $show->field('proof_of_payment', __('admin.form.Proof of payment'))->as(function ($receipt) {
            return $receipt == null ? 'Aucun fichier téléchargé.' : '<a href="/storage/' . $receipt . '" target="_blank">View receipt</a>';
        })->unescape();
        $show->field('applicant_remarks', __('admin.form.Applicant remarks'));
        $show->field('status', __('admin.form.Status'))->as(function ($status) {
            return Utils::tell_status($status)??"-";
        })->unescape();

        //disable edit button and delete button
        $show->panel()->tools(function ($tools) {
            $tools->disableEdit();
            $tools->disableDelete();
        });
        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new SeedLab());


        //get looged in user
        $user = Admin::user();
       
        if ($form->isCreating()) 
        {
            $form->hidden('user_id')->default($user->id);

           // compare the quantity requested and the quantity available
            $form->saving(function (Form $form) 
            {
               $load_stock_quantity = LoadStock::where('id', $form->load_stock_id)->first();
                
                $form->crop_variety_id = $load_stock_quantity->crop_variety_id;

             
            });
        }

         //onsaved return to the list page
         $form->saved(function (Form $form) 
        {
            admin_toastr(__('admin.form.Form submitted successfully'), 'success');
            return redirect('/seed-sample-requests');
        });

        $crop_stock = LoadStock::where('user_id', $user->id);

        //forms for user and seed producer
         if (!auth('admin')->user()->inRoles(['commissioner','developer','inspector','basic-user'])) 
        {
            $form->text('sample_request_number', __('admin.form.Sample request number'))->default('SRN' . date('YmdHis'))->readonly();
            $form->select('load_stock_id', __('admin.form.Load stock number'))->options($crop_stock->pluck('load_stock_number', 'id'))->attribute('id', 'load_stock_id')->required();
            
            $form->text('', __('admin.form.Name of producer'))->attribute('id', 'producer')->readonly();
            
            // } 
            // elseif(auth('admin')->user()->isRole('cooperative')){
            //     $form->text('', __('admin.form.Name of producer'))->attribute('id', 'coopproducer')->readonly();
            
            // }
            $form->text('year_of_production', __('admin.form.Year of production'));
            $form->number('number_of_samples', __('admin.form.Number of samples'));
            $form->number('quantity', __('admin.form.Sample size(kgs)'));
            $form->date('sample_request_date', __('admin.form.Sample request date'))->default(date('Y-m-d'))->required(); 
            $form->file('proof_of_payment', __('admin.form.Proof of payment'))
            ->rules(['mimes:jpeg,pdf,jpg', 'max:1048']) // Assuming a maximum file size of 1MB 
            ->help(__('admin.form.Attach a copy of your proof of payment, and should be in pdf, jpg or jpeg format'));
            $form->textarea('applicant_remarks', __('admin.form.Applicant remarks'));
            $form->hidden('crop_variety_id');
        }

        if ($form->isEditing()) 
        {

            $form_id = request()->route()->parameters()['seed_sample_request'];
             //check if its valid to edit the form
            Validation::checkFormEditable($form, $form_id , 'SeedLab');
            $seed_lab = SeedLab::find($form_id);

            $crop_declaration = LoadStock::where('id', $seed_lab->load_stock_id)->where('user_id', $seed_lab->user_id)->value('crop_declaration_id');
            if($crop_declaration != null)
            {
                //get crop variety from crop_declaration id
                $crop_variety_id = CropDeclaration::where('id', $crop_declaration)->value('crop_variety_id');
                //get field size
                $crop_field_size = CropDeclaration::where('id', $crop_declaration)->value('garden_size');
                //get crop variety name from crop_variety id
                $crop_variety = CropVariety::where('id', $crop_variety_id)->first();
                //get crop name from crop variety
                $crop_name = Crop::where('id', $crop_variety->crop_id)->value('crop_name');
                $load_stock_number = LoadStock::where('id', $seed_lab->load_stock_id)->value('load_stock_number');
                // name of producer
                $loadStock = LoadStock::where('id', $seed_lab->load_stock_id)->first();
                
                // $user = \App\Models\User::find($loadStock->user_id);
                $user = Administrator::find($loadStock->user_id);

                if ($user->isRole('cooperative')) {
                    $coopProducer = CooperativeMember::where('id', $loadStock->producer)->first();
                    if ($coopProducer) {
                        $fullName = $coopProducer->farmer_first_name . ' ' . $coopProducer->farmer_last_name;
                    }
                } elseif ($user->isRole('outgrower')) {
                    $producer = OutGrower::where('id', $loadStock->producer)->first();
                    if ($producer) {
                        $fullName = $producer->first_name . ' ' . $producer->last_name;
                        
                    }
                }

                $applicant_name = Administrator::where('id', $seed_lab->user_id)->value('name');
                $seed_class = LoadStock::where('id', $seed_lab->load_stock_id)->where('user_id', $seed_lab->user_id)->value('seed_class');
                $seed_class_name = SeedClass::where('id',$seed_class)->value('class_name');

                if (auth('admin')->user()->inRoles(['inspector', 'commissioner','developer'])) 
                {

                    $form->display('', __('admin.form.Applicant name'))->default($applicant_name);
                    $form->display('', __('admin.form.Load stock number'))->default($load_stock_number);
                    $form->display('', __('admin.form.Name of producer'))->default($fullName?? 'N/A');
                    $form->display('', __('admin.form.Field size'))->default($crop_field_size);
                    $form->display('', __('admin.form.Crop'))->default($crop_name);
                    $form->display('', __('admin.form.Variety'))->default($crop_variety->crop_variety_name);
                    $form->display('', __('admin.form.Seed generation'))->default($seed_class_name);
                    $form->date('sample_request_date', __('admin.form.Sample request date'))->default(date('Y-m-d'))->readonly();
                    $form->file('proof_of_payment', __('admin.form.Proof of payment'))->readonly();
                    $form->display('applicant_remarks', __('admin.form.Applicant remarks'))->readonly();
                }
            }

            else
            {

                  //get crop variety from crop_declaration id
                  $crop_variety_id = CropDeclaration::where('id', $crop_declaration)->value('crop_variety_id');
              
                  $load_stock = LoadStock::find($seed_lab->load_stock_id);
                  //get load stock number
                  $load_stock_number = $load_stock->load_stock_number;
                  //get crop variety name from crop_variety id
                  $crop_variety = CropVariety::where('id', $load_stock->crop_variety_id)->first();
                  //get crop name from crop variety
                  $crop_name = Crop::where('id', $crop_variety->crop_id)->value('crop_name');
                  //get applicant name
                  $applicant_name = Administrator::where('id', $seed_lab->user_id)->value('name');
                  //get seed class name
                  $seed_class_name = SeedClass::where('id',$load_stock->seed_class)->value('class_name');
                
                    $form->display('', __('admin.form.Applicant name'))->default($applicant_name);
                    $form->display('', __('admin.form.Load stock number'))->default($load_stock_number);
                    $form->display('', __('admin.form.Crop'))->default($crop_name);
                    $form->display('', __('admin.form.Variety'))->default($crop_variety->crop_variety_name);
                    $form->display('', __('admin.form.Seed generation'))->default($seed_class_name);
                    $form->date('sample_request_date', __('admin.form.Sample request date'))->default(date('Y-m-d'))->readonly();
                    $form->file('proof_of_payment', __('admin.form.Proof of payment'))->readonly();
                    $form->display('applicant_remarks', __('admin.form.Applicant remarks'))->readonly();
                 
            }

            if (auth('admin')->user()->inRoles(['commissioner','developer'])) 
            {
                $form->divider(__('admin.form.Administrator decision'));
                $form->textarea('additional_instructions', __('admin.form.Additional instructions'));
                $form->radioButton('status', __('admin.form.Decision'))
                ->options([
                    'halted' => __('admin.form.Halted'),
                    'rejected' => __('admin.form.Rejected'),
                    'inspector assigned' => __('admin.form.Assign Inspector'),
                ])
                    ->when('in', ['rejected', 'halted'], function (Form $form) {
                        $form->textarea('status_comment', __('admin.form.Status comment'))->rules('required');
                    })
                   
                    ->when('inspector assigned', function (Form $form) {
                       //get all inspectors
                        $inspectors = \App\Models\Utils::get_inspectors();
                        $form->select('inspector_id', __('admin.form.Assign inspector'))
                            ->options($inspectors)->rules('required');
                        $form->date('reporting_date', __('admin.form.Expected reporting date'))->default(date('Y-m-d'))->rules('required');
                    })->required();
            }

            if (auth('admin')->user()->isRole('inspector')) 
            {
                $form->divider(__('admin.form.Inspector decision'));

                $seedClasses = SeedClass::pluck('class_name', 'id');
                $form->select('seed_generation', __('admin.form.Seed generation'))
                ->options($seedClasses )
                ->required();
                $form->text('sample_request_number', __('admin.form.Sample request number'))->readonly();
                $form->decimal('validated_stock', __('admin.form.Validate farmer\'s stock(kgs)'))->required();
                $form->textarea('additional_instructions', __('admin.form.Any other information'));
                $form->radioCard('status', __('admin.form.Decision'))->options([
                    'halted' => __('admin.form.Halted'),
                    'rejected' => __('admin.form.Rejected'),
                    'lab test assigned' => __('admin.form.Assign Lab Test')
                ])
                    ->when('in', ['rejected', 'halted'], function (Form $form) {
                        $form->textarea('status_comment', __('admin.form.Status comment'))->rules('required');
                    });
                
               
            }

        }

        //disable delete button
        $form->tools(function (Form\Tools $tools) {
            $tools->disableView();
            $tools->disableDelete();
        });

        Admin::script('
            $("#load_stock_id").change(function () {
                    var id = $(this).val();
                    // var id = $("#crop_declaration_id").val();
            
                    $.ajax({
                        url: "/getproducer/" + id,
                        method: "GET",
                        dataType: "json",
                        success: function(data) {
                            // let producerName = Object.values(data.producer)[0]; // Get first value
                            // $("#producer").val(producerName);
                            $("#producer").val(data.producer);
                        },
                        error: function (error) {
                            console.log(error);
                        }
                    });
                


            });

            $(document).ready(function() {
                if($("#load_stock_id").val()){
                    var id = $("#load_stock_id").val();
            
                    $.ajax({
                        url: "/getproducer/" + id,
                        method: "GET",
                        dataType: "json",
                        success: function(data) {
                            // let producerName = Object.values(data.producer)[0]; // Get first value
                            // $("#producer").val(producerName);
                            $("#producer").val(data.producer);
                        },
                        error: function (error) {
                            console.log(error);
                        }
                    });
                }

                // });
            });

        ');

        //disable checkboxes
        $form->disableViewCheck();
        $form->disableEditingCheck();
        $form->disableCreatingCheck();

        return $form;
    }

    public function getProducers($id)
    {
        // Get the LoadStock record
        $loadStock = \App\Models\LoadStock::find($id);

        // Get the user who created the LoadStock
        $user = auth('admin')->user();
        // $user = \App\Models\User::find($loadStock->user_id);

        $fullName = 'N/A'; // Default fallback name

        // Check if the user is a cooperative or outgrower and fetch producer details
    if ($user->isRole('cooperative')) {
        $coopProducer = CooperativeMember::where('id', $loadStock->producer)->first();
        if ($coopProducer) {
            $fullName = $coopProducer->farmer_first_name . ' ' . $coopProducer->farmer_last_name;
        }
    } elseif ($user->isRole('outgrower')) {
        $producer = OutGrower::where('id', $loadStock->producer)->first();
        if ($producer) {
            $fullName = $producer->first_name . ' ' . $producer->last_name;
            
        }
    }
    Log::info('$fullName');

    return response()->json([
        'producer' => $fullName,
        ]);
    }
}
