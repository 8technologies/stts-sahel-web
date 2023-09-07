<?php

namespace App\Admin\Controllers;

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
use \App\Models\SeedClass;
use \App\Models\Utils;
use \App\Models\Validation;

class SeedSampleController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Seed Sample Request';

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

        //order of the table 
        $grid->model()->orderBy('id', 'desc');
       
       //function to show the loggedin user only what belongs to them
       Validation::showUserForms($grid);

        if (!$user->inRoles(['grower','agro-dealer'])) {
            $grid->disableCreateButton();
        }


        $grid->column('id', __('Id'));
        $grid->column('sample_request_number', __('admin.form.Sample request number'));
         $grid->column('user_id', __('admin.form.Applicant'))
        ->display(function ($user_id) {
            return \App\Models\User::find($user_id)->name??'-';
        });
        $grid->column('load_stock_id', __('admin.form.Crop stock number'));
        $grid->column('sample_request_date', __('admin.form.Sample request date'));
        $grid->column('status', __('admin.form.Status'))->display(function ($status) {
            return \App\Models\Utils::tell_status($status) ?? '-';
        });
        $grid->column('applicant_remarks', __('admin.form.Applicant remarks'));

        //disable delete button
        $grid->actions(function ($actions) {
            $actions->disableDelete();
        });
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
               return(' <p class="alert alert-danger">You do not have rights to view this form. <a href="/admin/seed-sample-requests"> Go Back </a></p> ');
           }


        $show->field('sample_request_number', __('admin.form.Sample request number'));
        $show->field('user_id', __('admin.form.Applicant id'))->as(function ($user_id) {
            return \App\Models\User::find($user_id)->name;
        });
        $show->field('load_stock_id', __('admin.form.Load stock number'));
        $show->field('sample_request_date', __('admin.form.Sample request date'));
        $show->field('proof_of_payment', __('admin.form.Proof of payment'))->file();
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

            //if form is saving get the crop variety id from the crop declaration
            $form->saving(function (Form $form) {
               $load_stock_quantity = LoadStock::where('id', $form->load_stock_id)->value('yield_quantity');
                if($form->quantity > $load_stock_quantity)
                {
                    return back()->withInput()->withErrors(['quantity' => 'The quantity requested is more than the available quantity in the crop stock']);
                }
                
            });
        }

         //check if the form is being edited
         if ($form->isEditing()) 
         {
             //get request id
             $id = request()->route()->parameters()['seed_sample_request'];
             //check if its valid to edit the form
             Validation::checkFormEditable($form, $id, 'SeedLab');
         }

         //onsaved return to the list page
         $form->saved(function (Form $form) 
        {
            admin_toastr(__('admin.form.Form submitted successfully'), 'success');
            return redirect('/admin/seed-sample-requests');
        });

        $crop_stock = LoadStock::where('user_id', $user->id);

        //forms for user and seed producer
        if (auth('admin')->user()->inRoles(['grower','agro-dealer'])) 
        {
            $form->text('sample_request_number', __('admin.form.Sample request number'))->default('SRN' . date('YmdHis'))->readonly();
            $form->select('load_stock_id', __('admin.form.Load stock number'))->options($crop_stock->pluck('load_stock_number', 'id'))->required();
            $form->number('quantity', __('admin.form.Quantity'))->required();
            $form->date('sample_request_date', __('admin.form.Sample request date'))->default(date('Y-m-d')); 
            $form->file('proof_of_payment', __('admin.form.Proof of payment'))
            ->rules(['mimes:jpeg,pdf,jpg', 'max:2048']) // Assuming a maximum file size of 2MB 
            ->help('Attach a copy of your proof of payment, and should be in pdf, jpg or jpeg format')
            ->required();
            $form->textarea('applicant_remarks', __('admin.form.Applicant remarks'));
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
                //get crop variety name from crop_variety id
                $crop_variety = CropVariety::where('id', $crop_variety_id)->first();
                //get crop name from crop variety
                $crop_name = Crop::where('id', $crop_variety->crop_id)->value('crop_name');

                $applicant_name = Administrator::where('id', $seed_lab->user_id)->value('name');
                $seed_class = LoadStock::where('id', $seed_lab->load_stock_id)->where('user_id', $seed_lab->user_id)->value('seed_class');
                $seed_class_name = SeedClass::where('id',$seed_class)->value('class_name');

                if (auth('admin')->user()->inRoles(['inspector', 'commissioner','developer'])) 
                {
                    $form->display('', __('admin.form.Applicant name'))->default($applicant_name);
                    $form->display('load_stock_id', __('admin.form.Load stock number'))->readonly();
                    $form->display('', __('admin.form.Crop'))->default($crop_name);
                    $form->display('', __('admin.form.Variety'))->default($crop_variety->crop_variety_name);
                    $form->display('', __('admin.form.Generation'))->default($seed_class_name);
                    $form->date('sample_request_date', __('admin.form.Sample request date'))->default(date('Y-m-d'))->readonly();
                    $form->file('proof_of_payment', __('admin.form.Proof of payment'))->readonly();
                    $form->display('applicant_remarks', __('admin.form.Applicant remarks'))->readonly();
                }
            }

            else
            {
                $crop_variety_id = LoadStock::where('id', $seed_lab->load_stock_id)->value('crop_variety_id');
                //get crop variety name from crop_variety id
                $crop_variety = CropVariety::where('id', $crop_variety_id)->first();
                //get crop name from crop variety
                $crop_name = Crop::where('id', $crop_variety->crop_id)->value('crop_name');
                //get the seed class
                $seed_class = LoadStock::where('id', $seed_lab->load_stock_id)->value('seed_class');
                $seed_class_name = SeedClass::where('id',$seed_class)->value('class_name');
                $applicant_name = Administrator::where('id', $seed_lab->user_id)->value('name');

                if (auth('admin')->user()->inRoles(['inspector', 'commissioner','developer'])) 
                {
                    $form->display('', __('admin.form.Applicant name'))->default($applicant_name);
                    $form->display('load_stock_id', __('admin.form.Load stock number'))->readonly();
                    $form->display('', __('admin.form.Crop'))->default($crop_name);
                    $form->display('', __('admin.form.Variety'))->default($crop_variety->crop_variety_name);
                    $form->display('', __('admin.form.Generation'))->default($seed_class_name);
                    $form->date('sample_request_date', __('admin.form.Sample request date'))->default(date('Y-m-d'))->readonly();
                    $form->file('proof_of_payment', __('admin.form.Proof of payment'))->readonly();
                    $form->display('applicant_remarks', __('admin.form.Applicant remarks'))->readonly();
                }
            }

            if (auth('admin')->user()->inRoles(['commissioner','developer'])) 
            {
                $form->divider(__('admin.form.Administrator decision'));
                $form->select('priority', __('admin.form.Priority'))->options(['low' => 'Low', 'medium' => 'Medium', 'high' => 'High']);
                $form->textarea('additional_instructions', __('admin.form.Additional instructions'));
                $form->radioButton('status', __('admin.form.Decision'))
                ->options([
                    'accepted'=> __('admin.form.Accepted'),
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
                $form->text('sample_request_number', __('admin.form.Sample request number'))->readonly();
                $form->display('priority', __('admin.form.Priority'));
                $form->textarea('additional_instructions', __('admin.form.Analyst Information'));
                $form->radioButton('status', __('admin.form.Decision'))->options([
                    'halted' => __('admin.form.Halted'),
                    'rejected' => __('admin.form.Rejected'),
                    'lab test assigned' => __('admin.form.Assign Lab Test')])
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

        //disable checkboxes
        $form->disableViewCheck();
        $form->disableEditingCheck();
        $form->disableCreatingCheck();

        return $form;
    }
}
