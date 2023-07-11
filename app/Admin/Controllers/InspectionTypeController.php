<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\InspectionType;

class InspectionTypeController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'InspectionType';

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

        $form->text('inspection_type_name', __('Inspection type name'));
        $form->text('order', __('Order'));
        $form->number('period_after_planting', __('Period after planting'));

        return $form;
    }
}
