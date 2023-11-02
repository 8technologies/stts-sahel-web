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
 
    
    public function __construct() {
        $this->title = __('admin.form.Crop');
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Crop());

        //filter by crop name
        $grid->filter(function ($filter) 
        {
            // Remove the default id filter
            $filter->disableIdFilter();
            $filter->like('crop_name', 'Crop name');
        });

        $grid->disableBatchActions();
        $grid->column('crop_name', __('admin.form.Crop name'));
        $grid->column('number_of_inspections', __('admin.form.Number of inspections'))->display(function () {
            return $this->inspection_types()->count();
        })->sortable();
        
        $grid->column('number_of_days_before_submission', __('admin.form.Number of days before submission of crop declaration'));
      


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

        $show->field('crop_name', __('admin.form.Crop name'));
        $show->field('crop_code', __('admin.form.Crop code'));
        $show->field('number_of_days_before_submission', __('admin.form.Number of days before submission of crop declaration'));
        $show->field('seed_viability_period', __('admin.form.Seed viability period (in days)'))->as(function ($seed_viability_period) {
            return $seed_viability_period ?? 'N/A';
        });

        $show->crop_varieties(__('admin.form.Crop varieties'), function ($crop_varieties) {
            $crop_varieties->resource('/admin/crop_varieties');
            $crop_varieties->crop_variety_name(__('admin.form.Crop variety name'));
            $crop_varieties->crop_variety_code(__('admin.form.Crop variety code'));
            //disable the filter
            $crop_varieties->disableFilter();
            //disable the export button
            $crop_varieties->disableExport();
            //disable the column selector
            $crop_varieties->disableColumnSelector();

           
        });

        $show->inspection_types(__('admin.form.Inspection types'), function ($inspection_types) {
            $inspection_types->resource('/admin/inspection_types');
            $inspection_types->inspection_type_name(__('admin.form.Inspection type name'));
            $inspection_types->order(__('admin.form.Order'));
            $inspection_types->period_after_planting(__('admin.form.Days after planting'));
            //disable the filter
            $inspection_types->disableFilter();
            //disable the export button
            $inspection_types->disableExport();
            //disable the column selector
            $inspection_types->disableColumnSelector();
          
           
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

        $form->text('crop_name', __('admin.form.Crop name'))->rules('required');
        // $form->text('crop_code', __('admin.form.Crop code'))->required();
        $form->decimal('number_of_days_before_submission', __('admin.form.Number of days before submission of crop declaration'))->required();
        $form->divider();
        $form->decimal('seed_viability_period', __('admin.form.Seed viability period (in days)')); 
        $form->hasMany('crop_varieties', __('admin.form.Crop Varieties'), function (Form\NestedForm $form)  {
            $form->text('crop_variety_name', __('admin.form.Crop Variety Name'))->required();
           
        });

      
        $form->morphMany('inspection_types',  __('admin.form.Inspection Types'), function (Form\NestedForm $form) {
            $form->text('inspection_type_name', __('admin.form.Inspection type name'))->rules('required');
            $form->decimal('order', __('admin.form.Order'))->rules('required');
            $form->decimal('period_after_planting', __('admin.form.Days after planting'))->rules('required');
        });


        return $form;
    }
}
