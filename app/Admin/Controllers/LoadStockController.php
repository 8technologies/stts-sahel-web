<?php

namespace App\Admin\Controllers;

use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use \App\Models\LoadStock;
use \Encore\Admin\Facades\Admin;
use \App\Models\Validation;
use \App\Models\Utils;

use \App\Models\CropDeclaration;

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

        if(!$user->isRole('commissioner')){
            $grid->model()->where('user_id', auth('admin')->user()->id);
        }

        if ($user->inRoles(['developer','commissioner','inspector',])){
            $grid->disableCreateButton();
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
        $grid->column('last_field_inspection_date', __('admin.form.Last field inspection date'));
     
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
        $show->field('registration_number', __('admin.form.Registration number'))->as(function ($value) {
            return \App\Models\SeedProducer::find($value)->producer_registration_number ?? '-';
        });
        $show->field('seed_class', __('admin.form.Seed class'))->as(function ($value) {
            return \App\Models\SeedClass::find($value)->class_name ?? '-';
        });
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
           
        if ($form->isCreating()) 
        {
            $form->hidden('user_id')->default($user->id);
        }

         //check if the form is being edited
         if ($form->isEditing()) 
        {
            //get request id
            $id = request()->route()->parameters()['load_stock'];
            //check if its valid to edit the form
            Validation::checkFormEditable($form, $id, 'LoadStock');
        }

        $form->saved(function (Form $form) 
        {
            admin_toastr(__('admin.form.Crop stock saved successfully'), 'success');
            return redirect('/load-stocks');
        });

        $form->text('load_stock_number', __('admin.form.Crop stock number'))->default('LS'.rand(1000, 100000))->readonly();

        //get all seed classes
        $seed_classes = \App\Models\SeedClass::all();
        $crop_declarations = CropDeclaration::where('user_id', $user->id)
        ->where('status', 'accepted')->get();
        
        $form->select('crop_declaration_id', __('admin.form.Crop Declaration'))->options($crop_declarations->pluck('field_name', 'id'))
        ->attribute('id', 'crop_declaration_id')
        ->required();
        $form->text('crop_variety_id', __('Crop Variety'))->attribute('id', 'crop_variety_id')->readonly();
        $form->text('seed_class', __('admin.form.Seed class'))->attribute('id', 'seed_class')->readonly();

        //script to get the crop variety id and seed class on crop declaration change
        Admin::script(
            <<<EOT
            $(document).ready(function() {
                $('#crop_declaration_id').change(function () {
                    var id = $(this).val();
        
                    $.ajax({
                        url: '/crop-declarations/' + id,
                        type: 'GET',
                        dataType: 'json',
                        success: function (response) {
                            console.log(response);
                            $('#crop_variety_id').val(response.crop_variety);
                            $('#seed_class').val(response.seed_class);
                        },
                        error: function (response) {
                            console.log(response);
                        }
                    });
                });
            });
            EOT
        );
        
        $form->hidden('last_field_inspection_date', __('Date'));  
        $form->decimal('field_size', __('admin.form.Field size(Acres)'))->required();
        $form->decimal('yield_quantity', __('admin.form.Yield quantity(kgs)'))->required();
        $form->date('load_stock_date', __('admin.form.Crop stock date'))->default(date('Y-m-d'))->required();
      
        //disable edit button and delete button
        $form->tools(function (Form\Tools $tools) {
            $tools->disableDelete();
            $tools->disableView();
        });

        //disable check boxes
        $form->footer(function ($footer) {
            $footer->disableViewCheck();
            $footer->disableEditingCheck();
            $footer->disableCreatingCheck();
        });

        return $form;
    }

    public function getVarieties($id)
    {
        $cropDeclaration = \App\Models\CropDeclaration::find($id);
        if (!$cropDeclaration) {
            return response()->json(['error' => 'Crop declaration not found'], 404);
        }
    
        $crop_variety_id = $cropDeclaration->crop_variety_id;
        $seed_class_id = $cropDeclaration->seed_class_id;
    
        if (!$crop_variety_id || !$seed_class_id) {
            return response()->json(['error' => 'Crop variety or seed class not found'], 500);
        }
    
        $seed_class = \App\Models\SeedClass::find($seed_class_id)->class_name;
        $crop_variety = \App\Models\CropVariety::find($crop_variety_id)->crop_variety_name;

    
        return response()
        ->json(['crop_variety_id' => $crop_variety_id, 'seed_class' => $seed_class, 'crop_variety' => $crop_variety])
        ->header('Content-Type', 'application/json');
    
    }
    
}
