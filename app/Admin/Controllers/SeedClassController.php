<?php

namespace App\Admin\Controllers;

use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use \App\Models\SeedClass;

class SeedClassController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected function title()
    {
        return trans('admin.form.Seed Category');
    }


    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new SeedClass());

        $grid->column('id', __('Id'));
        $grid->column('class_name', __('admin.form.Category'));
        $grid->column('class_code', __('admin.form.Category code'));
        //display created at in human readable format
        $grid->column('created_at', __('admin.form.Created at'))->display(function ($created_at) {
            return date('d-m-Y H:i:s', strtotime($created_at));
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
        $show = new Show(SeedClass::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('class_name', __('admin.form.Category'));
        $show->field('class_code', __('admin.form.Category code'));
        $show->field('created_at', __('admin.form.Created at'))->display(function ($created_at) {
            return date('d-m-Y H:i:s', strtotime($created_at));
        });
        $show->field('updated_at', __('admin.form.Updated at'))->display(function ($updated_at) {
            return date('d-m-Y H:i:s', strtotime($updated_at));
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
        $form = new Form(new SeedClass());

        $form->text('class_name', __('admin.form.Category'))->required();
        $form->text('class_code', __('admin.form.Category code'))->required();

        return $form;
    }
}
