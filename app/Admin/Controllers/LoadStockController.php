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
use \App\Models\CropVariety;
use \App\Models\SeedClass;

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
    
        $form->saved(function (Form $form) 
        {
            admin_toastr(__('admin.form.Crop stock saved successfully'), 'success');
            return redirect('/load-stocks');
        });
    
        if ($form->isEditing()) 
        {
            $id = request()->route()->parameters()['load_stock'];
            Validation::checkFormEditable($form, $id, 'LoadStock');
        }
    
        $form->text('load_stock_number', __('admin.form.Crop stock number'))->default('LS'.rand(1000, 100000))->readonly();
        $crop_declarations = CropDeclaration::where('user_id', $user->id)
            ->where('status', 'accepted')->get();
    
        if($user->isRole('agro-dealer')){
            $form->select('crop_variety_id', __('admin.form.Crop Variety'))->options(CropVariety::pluck('crop_variety_name', 'id'));
            $form->select('seed_class', __('admin.form.Seed class'))->options(SeedClass::pluck('class_name', 'id')); 
        }
        else{
            $form->select('crop_declaration_id', __('admin.form.Crop Declaration'))
                ->options($crop_declarations->pluck('field_name', 'id'))
                ->attribute('id', 'crop_declaration_id')
                ->required();
    
            $form->hidden('crop_variety_id', __('admin.form.Crop Variety'))->attribute('id', 'crop_variety_id')->required();
            $form->text('', __('admin.form.Crop Variety Name'))->attribute('id', 'crop_variety_name')->readonly();
    
            $form->hidden('seed_class', __('admin.form.Seed class'))->attribute('id', 'seed_class_id')->required();
            $form->text('', __('admin.form.Seed class Name'))->attribute('id', 'seed_class')->readonly();  
        }
    
        $form->decimal('field_size', __('admin.form.Field size(Acres)'))->required();
        $form->decimal('yield_quantity', __('admin.form.Yield quantity(kgs)'))->required();
        $form->date('load_stock_date', __('admin.form.Crop stock date'))->default(date('Y-m-d'))->required();
        $form->hidden('last_field_inspection_date', __('admin.form.Date'))->attribute('id', 'last_field_inspection_date');
    
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
                $("#crop_declaration_id").change(function () {
                    var id = $(this).val();
            
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
        $crop_variety = \App\Models\CropVariety::find($crop_variety_id);
    
        $seed_class_id = $cropDeclaration->seed_class_id;
        $seed_class = \App\Models\SeedClass::find($seed_class_id);
    
        return response()->json([
            'crop_variety_id' => $crop_variety_id,
            'crop_variety' => $crop_variety->crop_variety_name,
            'seed_class_id' => $seed_class_id,
            'seed_class' => $seed_class->class_name,
            'last_field_inspection_date' => $cropDeclaration->updated_at->format('Y-m-d'),
        ]);
    }
    
    
}
