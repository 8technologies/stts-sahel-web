<?php

namespace App\Admin\Controllers;

use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use \App\Models\LoadStock;
use \Encore\Admin\Facades\Admin;

use \App\Models\CropDeclaration;

class LoadStockController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'LoadStock';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new LoadStock());
        $user = Admin::user();
        if(!$user->isRole('commissioner')){
            $grid->model()->where('applicant_id', auth('admin')->user()->id);
        }

        if (!$user->inRoles(['basic-user','grower'])){
            $grid->disableCreateButton();
        }

        $grid->column('id', __('Id'));
        $grid->column('load_stock_number', __('Load stock number'));
        $grid->column('applicant_id', __('Applicant Name'))->display(function ($applicant_id) {
            return \App\Models\User::find($applicant_id)->name;
        });
        $grid->column('yield_quantity', __('Yield quantity'));
        $grid->column('last_field_inspection_date', __('Last field inspection date'));
     
        

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

        $show->field('id', __('Id'));
        $show->field('load_stock_number', __('Load stock number'));
        $show->field('crop_declaration_id', __('Crop Declaration'));
        $show->field('applicant_id', __('Applicant id'));
        $show->field('registration_number', __('Registration number'));
        $show->field('seed_class', __('Seed class'));
        $show->field('field_size', __('Field size'));
        $show->field('yield_quantity', __('Yield quantity'));
        $show->field('last_field_inspection_date', __('Last field inspection date'));
        $show->field('load_stock_date', __('Load stock date'));
        $show->field('last_field_inspection_remarks', __('Last field inspection remarks'));
       
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
           
            if ($form->isCreating()) {
                $form->hidden('applicant_id')->default($user->id);
            }

        $form->text('load_stock_number', __('Load stock number'))->default('LS'.date('YmdHis'));

        $crop_declarations = CropDeclaration::where('applicant_id', $user->id)
        ->where('status', 'accepted')->get();
        
        $form->select('crop_declaration_id', __('Crop Declaration'))->options($crop_declarations->pluck('field_name', 'id'));
        $form->text('registration_number', __('Registration number'));
        $form->text('seed_class', __('Seed class'));
        $form->decimal('field_size', __('Field size'));
        $form->decimal('yield_quantity', __('Yield quantity'));
        $form->date('last_field_inspection_date', __('Last field inspection date'))->default(date('Y-m-d'));
        $form->date('load_stock_date', __('Load stock date'))->default(date('Y-m-d'));
        $form->textarea('last_field_inspection_remarks', __('Last field inspection remarks'));
     
       //when saving, check if the quantity of seed planted of the selected crop declaration is less than the yield quantity
        $form->saving(function (Form $form) {
            if($form->crop_declaration_id != null){
            $crop_declaration = CropDeclaration::find($form->crop_declaration_id);
            if($crop_declaration->quantity_of_seed_planted < $form->yield_quantity){
                admin_error('Yield quantity cannot be greater than the seed planted quantity');
                return back();
            }
        }
        });

        //disable edit button and delete button
        $form->tools(function (Form\Tools $tools) {
            $tools->disableDelete();
            $tools->disableView();
        });

        return $form;
    }
}
