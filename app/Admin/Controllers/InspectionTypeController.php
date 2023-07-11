<?php

namespace App\Admin\Controllers;

use App\Models\Crop;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use \App\Models\InspectionType;

class InspectionTypeController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Inspection Type';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new InspectionType());

        $grid->column('id', __('Id'));
        $grid->column('inspection_type_name', __('Inspection type name'));
        $grid->column('order', __('Order'));
        $grid->column('period_after_planting', __('Period after planting'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        $grid->column('crop_id', __('Crop'));

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
        $show = new Show(InspectionType::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('inspection_type_name', __('Inspection type name'));
        $show->field('order', __('Order'));
        $show->field('period_after_planting', __('Period after planting'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('crop_id', __('Crop id'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new InspectionType());

        $form->select('crop_id', __('Crop'))
            ->options(Crop::all()->pluck('crop_name', 'id'))
            ->required();
        $form->text('inspection_type_name', __('Inspection type name'))->rules('required');
        $form->decimal('order', __('Order'))->rules('required');
        $form->decimal('period_after_planting', __('Days after planting'))->rules('required');

        return $form;
    }
}
