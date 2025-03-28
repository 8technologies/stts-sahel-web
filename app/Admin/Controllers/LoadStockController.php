<?php

namespace App\Admin\Controllers;

use App\Models\Cooperative;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use \App\Models\LoadStock;
use \Encore\Admin\Facades\Admin;
use \App\Models\Validation;
use \App\Models\Utils;
use \App\Models\CropVariety;
use \App\Models\SeedClass;

use \App\Models\CropDeclaration;
use App\Models\SeedProducer;
use App\Models\User;
use Encore\Admin\Admin as AdminAdmin;
use Encore\Admin\Auth\Database\Administrator;
use Illuminate\Support\Facades\Log;

class LoadStockController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected function title()
    {
        return trans('admin.form.Crop stock');
    }


    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new LoadStock());
        $user = Admin::user();

        //disable batch and export actions
        Utils::disable_batch_actions($grid);

        //filter by stock number
        //disable filter
        $grid->disableFilter();
        $grid->quickSearch('load_stock_number');

        if(!$user->isRole('commissioner')){
            $grid->model()->where('user_id', auth('admin')->user()->id);
            $grid->actions(function ($actions) {
                    
                if ($actions->row->checked == 1) {
                    $actions->disableDelete();
                    $actions->disableEdit();
                }
            });

        }

        if ($user->inRoles(['developer','commissioner','inspector',])){
            $grid->disableCreateButton();
            //disable actions
            $grid->disableActions();
        }
        
        $grid->column('load_stock_number', __('admin.form.Crop stock number'));
        $grid->column('user_id', __('admin.form.Applicant name'))->display(function ($user_id) {
            return \App\Models\User::find($user_id)->name;
        });
        $grid->column('yield_quantity', __('admin.form.Yield quantity(kgs)'))->display(function ($yield_quantity) {
            return number_format($yield_quantity).' kgs';
        });
        $grid->column('status', __('admin.form.Status'))->display(function ($status){
            return Utils::tell_status($status);
        });
        $grid->column('last_field_inspection_date', __('admin.form.Last field inspection date'))->display(function ($last_field_inspection_date) {
            return date('d-m-Y', strtotime($last_field_inspection_date))?? '-';
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
        $show = new Show(LoadStock::findOrFail($id));

        //check if the user is the owner of the form
        $showable = Validation::checkUser('LoadStock', $id);
        if (!$showable) 
        {
            return(' <p class="alert alert-danger">You do not have rights to view this form. <a href="/load-stocks"> Go Back </a></p> ');
        }

        $show->field('load_stock_number', __('admin.form.Load stock number'));
        $show->field('crop_declaration_id', __('admin.form.Crop Declaration'))->as(function ($value) {
            $crop_variety_id = \App\Models\CropDeclaration::find($value)->crop_variety_id;
            return \App\Models\CropVariety::find($crop_variety_id)->crop_variety_name ?? '-';
        });;
        $show->field('user_id', __('admin.form.Applicant'))->as(function ($value) {
            return \App\Models\User::find($value)->name ?? '-';
        });
        $show->field('seed_class', __('admin.form.Seed class'))->as(function ($crop_variety_id) {
            $cropVariety = \App\Models\CropVariety::with('crop')->find($crop_variety_id);
        
            if ($cropVariety && $cropVariety->crop) {
                return $cropVariety->crop->crop_name . ' - (' . $cropVariety->crop_variety_name.')';
            }
        
            return 'N/A'; // Fallback in case of missing data
        });
        $userId = $show->getModel()->user_id; 
        // $user = \App\Models\User::find($userId); // Get the actual user model
        $usp = Admin::user($userId);
        $user = Administrator::whereHas('roles', function ($query) {
            $query->where('id', 4);
        })->pluck('name', 'id');

        Log::info($user);

        // Check the user's role and display the correct producer
        if ($usp->isRole('grower')) {
            $seed_producer = SeedProducer::where('user_id', $usp->id)->first();
            $producerOptions = $seed_producer ? Utils::get_out_growers($seed_producer->id) : [];
        } elseif ($usp->isRole('cooperative')) {
            $cooperative = Cooperative::where('user_id', $usp->id)->first();
            $producerOptions = $cooperative ? Utils::get_cooperative_members($cooperative->id) : [];
            Log::info($producerOptions);
        } else {
            $producerOptions = [];
        }

        // Display Producer Name (if available)
        $show->field('producer', __('admin.form.Producer Name'))->as(function ($value) use ($producerOptions, $usp) {
            return $producerOptions[$value] ?? 'N/A';
        });

        // // if($user->roles->contains('name', 'grower')){
        // if($usp->isRole('grower')){
        //     $show->field('producer', __('admin.form.Producer Name'))->as(function ($value) {
                
        //         $seed_producer = SeedProducer::where('user_id', $user->id)->first();

        //         return Utils::get_out_growers($seed_producer->id);
        //     });
        // }
        // // if($user->roles->contains('name', 'cooperative')){
        // if($usp->isRole('cooperative')){
        //     $cooperatives = Cooperative::where('user_id', $user->id)->first();
        //     Log::info($show->model()->user_id);
        
        //     $show->field('producer', __('admin.form.Producer Name'))->options(Utils::get_cooperative_members($cooperatives->id));
        // }
        $show->field('field_size', __('admin.form.Field size(Acres)'));
        $show->field('yield_quantity', __('admin.form.Yield quantity(kgs)'));
        $show->field('last_field_inspection_date', __('admin.form.Last field inspection date'));
        $show->field('load_stock_date', __('admin.form.Crop stock date'));
        
       
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
        $form = new Form(new LoadStock());
        $user = auth()->user();
    
        $form->saved(function (Form $form) 
        {
            admin_toastr(__('admin.form.Crop stock saved successfully'), 'success');
            return redirect('/load-stocks');
        });
    
        $form->text('load_stock_number', __('admin.form.Crop stock number'))->default('LS'.rand(1000, 100000))->readonly();
        $crop_declarations = CropDeclaration::where('user_id', $user->id)
            ->where('status', 'accepted')->get();
    
        $form->select('crop_declaration_id', __('admin.form.Crop Declaration'))
            ->options($crop_declarations->pluck('field_name', 'id'))
            ->attribute('id', 'crop_declaration_id')
            ->required();

        $form->hidden('crop_variety_id', __('admin.form.Crop Variety'))->attribute('id', 'crop_variety_id')->required();
        $form->text('', __('admin.form.Crop Variety Name'))->attribute('id', 'crop_variety_name')
        ->options(Utils::get_varieties())
        ->readonly();

        $form->hidden('seed_class', __('admin.form.Seed generation'))->attribute('id', 'seed_class_id')->required();
        $form->text('', __('admin.form.Seed generation'))->attribute('id', 'seed_class')->readonly(); 

        // if ($form->isCreating()) 
        // {
            $form->hidden('user_id')->default($user->id);
            Log::info($form->model()->user_id);
            Log::info($user->id);
            $seed_producer = SeedProducer::where('user_id', $user->id)->first();

            if($user->isRole('grower')){
                $form->select('producer', __('admin.form.Producer Name'))->options(Utils::get_out_growers($seed_producer->id));
            }
            if($user->isRole('cooperative')){
                $cooperatives = Cooperative::where('user_id', $user->id)->first();
                Log::info($form->model()->user_id);
            
                $form->select('producer', __('admin.form.Producer Name'))->options(Utils::get_cooperative_members($cooperatives->id));
            }

        // }
        // elseif($form->isEditing()){
        //     $id = request()->route()->parameters()['load_stock'];
        //     Validation::checkFormEditable($form, $id, 'LoadStock');
            
        //     $loadStock = $form->model(); // Get the model being edited
        //     Log::info('Editing LoadStock - Full Model:', $loadStock->toArray());
            
        //     $user = User::where('id', $loadStock->user_id)->first(); // Added ->first()
        //     if ($user) {
        //         $seed_producer = SeedProducer::where('user_id', $loadStock->user_id)->first();
        //         if($user->isRole('outgrower') && $seed_producer){
        //             $form->select('producer', __('admin.form.Producer'))->options(Utils::get_out_growers($seed_producer->id));
        //         }
        //         if($user->isRole('cooperative')){
        //             $cooperatives = Cooperative::where('user_id', $loadStock->user_id)->first();
        //             if ($cooperatives) {
        //                 $form->select('producer', __('admin.form.Producer'))->options(Utils::get_cooperative_members($cooperatives->id));
        //             }
        //         }
        //     }
        // }

        $form->decimal('field_size', __('admin.form.Field size(Acres)'))->required();
        $form->decimal('yield_quantity', __('admin.form.Production(kgs)'))->required();
        $form->date('last_field_inspection_date', __('admin.form.Last inspection date'))->attribute('id', 'last_field_inspection_date')->readonly();
        $form->date('load_stock_date', __('admin.form.Crop stock date'))->default(date('Y-m-d'))->required();
        
        $form->tools(function (Form\Tools $tools) {
            $tools->disableDelete();
            $tools->disableView();
        });
    
        $form->footer(function ($footer) {
            $footer->disableViewCheck();
            $footer->disableEditingCheck();
            $footer->disableCreatingCheck();
        });
    
        Admin::script
        ('
            $(document).ready(function() {
                // $("#crop_declaration_id").change(function () {
                //     var id = $(this).val();
                if($("#crop_declaration_id").val()){
                    var id = $("#crop_declaration_id").val();
            
                    $.ajax({
                        url: "/getVarieties/" + id,
                        method: "GET",
                        dataType: "json",
                        success: function(data) {
                            $("#crop_variety_id").val(data.crop_variety_id);
                            $("#crop_variety_name").val(data.crop_variety);
                            $("#seed_class_id").val(data.seed_class_id);
                            $("#seed_class").val(data.seed_class);
                            $("#last_field_inspection_date").val(data.last_field_inspection_date);
                        },
                        error: function (error) {
                            console.log(error);
                        }
                    });
                }

                $("#crop_declaration_id").change(function () {
                    var id = $(this).val();
                    // var id = $("#crop_declaration_id").val();
            
                    $.ajax({
                        url: "/getVarieties/" + id,
                        method: "GET",
                        dataType: "json",
                        success: function(data) {
                            $("#crop_variety_id").val(data.crop_variety_id);
                            $("#crop_variety_name").val(data.crop_variety);
                            $("#seed_class_id").val(data.seed_class_id);
                            $("#seed_class").val(data.seed_class);
                            $("#last_field_inspection_date").val(data.last_field_inspection_date);
                        },
                        error: function (error) {
                            console.log(error);
                        }
                    });
                


                });


                // });
            });

            $(document).ready(function() {
                
            });
        ');
    
        return $form;
    }
    
    public function getVarieties($id)
    {
        $cropDeclaration = \App\Models\CropDeclaration::find($id);
        if (!$cropDeclaration) {
            return response()->json(['error' => 'Crop declaration not found'], 404);
        }
    
        $crop_variety_id = $cropDeclaration->crop_variety_id;
        $variety =\App\Models\CropVariety::with('crop')->find($crop_variety_id);
        // $crop_variety = 
        // $cropVariety = \App\Models\CropVariety::with('crop')->find($form->model()->crop_variety_id);
            // if ($crop_variety && $crop_variety->crop) {
        $crop_variety = $variety->crop->crop_name . ' - ' . $variety->crop_variety_name;
            // }
    
        $seed_class_id = $cropDeclaration->seed_class_id;
        $seed_class = \App\Models\SeedClass::find($seed_class_id);
    
        return response()->json([
            'crop_variety_id' => $variety->id,
            'crop_variety' => $crop_variety,
            'seed_class_id' => $seed_class_id,
            'seed_class' => $seed_class->class_name,
            'last_field_inspection_date' => $cropDeclaration->updated_at->format('Y-m-d'),
        ]);
    }
    
    
}


