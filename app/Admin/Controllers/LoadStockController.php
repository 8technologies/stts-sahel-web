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
        $grid->column('crop_declaration_id', __('Crop Declaration'));
        $grid->column('applicant_id', __('Applicant id'));
        $grid->column('registration_number', __('Registration number'));
        $grid->column('seed_class', __('Seed class'));
        $grid->column('field_size', __('Field size'));
        $grid->column('yield_quantity', __('Yield quantity'));
        $grid->column('last_field_inspection_date', __('Last field inspection date'));
        $grid->column('load_stock_date', __('Load stock date'));
        $grid->column('last_field_inspection_remarks', __('Last field inspection remarks'));
        $grid->column('valid_from', __('Valid from'));
        $grid->column('valid_until', __('Valid until'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        $grid->column('status', __('Status'));

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
        $show->field('valid_from', __('Valid from'));
        $show->field('valid_until', __('Valid until'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('status', __('Status'));

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

        $form->text('load_stock_number', __('Load stock number'));

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
        $form->date('valid_from', __('Valid from'))->default(date('Y-m-d'));
        $form->date('valid_until', __('Valid until'))->default(date('Y-m-d'));
        $form->number('status', __('Status'));

        return $form;
    }
}
