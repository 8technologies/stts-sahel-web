<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\Crop;
use \App\Models\InspectionType;

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

        $grid->column('id', __('Id'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        $grid->column('crop_name', __('Crop Name'));
        $grid->column('number_of_days_before_submission', __('Number of days before submission'));

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
        $show->field('crop_name', __('Crop Name'));
        $show->field('number_of_days_before_submission', __('Number of days before submission'));
     
        $show->id(__('Crop varieties'))->unescape()->as(function ($id) {
            $crop = Crop::with('crop_varieties')->findOrFail($id);
            $crop_varieties = $crop->crop_varieties->pluck('crop_variety_name')->implode(', ');
            return "<p>{$crop_varieties}</p>";
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

        $form->textarea('crop_name', __('Crop Name'));
        $form->number('number_of_days_before_submission', __('Number of days before submission'));
        $form->multipleSelect('inspection_types', __('admin.form.Select Inspections'))->options(InspectionType::all()->pluck('inspection_type_name', 'id'));

        $form->hasMany('crop_varieties', function (Form\NestedForm $form)  {
            $form->text('crop_variety_name', __('Crop Variety Name'));
            $form->text('crop_variety_code', __('Crop Variety Code'));
            $form->text('crop_variety_generation', __('Crop Variety Generation'));
        });
        
        


     
        return $form;
    }
}
