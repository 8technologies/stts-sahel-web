<?php

namespace App\Admin\Controllers;

use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use \App\Models\Crop;

class CropController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Crop';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Crop());

        $grid->disableBatchActions();
        $grid->column('id', __('Id'))->sortable();
        $grid->column('crop_name', __('Crop name'));
        $grid->column('number_of_inspections', __('No. of inspections'))->display(function () {
            return $this->inspection_types()->count();
        })->sortable();
        $grid->column('number_of_days_before_submission', __('Number of days before submission of planting return'));
        $grid->column('seed_viability_period', __('Seed viability period (in days)'));
        $grid->column('number_of_inspections', __('Number of inspections'))->sortable();

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
        $show = new Show(Crop::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('crop_name', __('Crop name'));
        $show->field('crop_code', __('Crop code'));
        $show->field('number_of_days_before_submission', __('Number of days before submission of planting return'));
        $show->field('seed_viability_period', __('Seed viability period (in days)'));

        $show->crop_varieties('Crop varieties', function ($crop_varieties) {
            $crop_varieties->resource('/admin/crop_varieties');
            $crop_varieties->crop_variety_name();
            $crop_varieties->crop_variety_code();
           // $crop_varieties->crop_variety_generation();
           
        });

        $show->inspection_types('Inspection types', function ($inspection_types) {
            $inspection_types->resource('/admin/inspection_types');
            $inspection_types->inspection_type_name();
            $inspection_types->order();
            $inspection_types->period_after_planting();
           
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
        $form = new Form(new Crop());

        $form->text('crop_name', __('Crop name'))->rules('required');
        $form->text('crop_code', __('Crop code'));
        $form->decimal('number_of_days_before_submission', __('Number of days before submission of planting return'));
        $form->decimal('seed_viability_period', __('Seed viability period (in days)')); 
        $form->divider();
        $form->hasMany('crop_varieties', function (Form\NestedForm $form)  {
            $form->text('crop_variety_name', __('Crop Variety Name'));
            $form->text('crop_variety_code', __('Crop Variety Code'));
            //get all seed class and display in dropdown
           // $form->select('crop_variety_generation', __('Crop Variety Generation'))->options(\App\Models\SeedClass::all()->pluck('class_name', 'id'));
          
        });

      
        $form->morphMany('inspection_types', function (Form\NestedForm $form) {
            $form->text('inspection_type_name', __('Inspection type name'))->rules('required');
            $form->decimal('order', __('Order'))->rules('required');
            $form->decimal('period_after_planting', __('Days after planting'))->rules('required');
        });


        return $form;
    }
}
