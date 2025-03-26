<?php

namespace App\Admin\Controllers;

use App\Models\Region;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use \App\Models\SeedClass;
use Encore\Admin\Auth\Database\Role;

class RegionContoller extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected function title()
    {
        return trans('admin.form.Region');
    }


    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Region());

        //filter by category name
        $grid->filter(function ($filter) {
            $filter->disableIdFilter();
            $filter->like('name', __('admin.form.Region name'));
        });
        $grid->disableBatchActions();

        $grid->column('id', __('Id'));
        $grid->column('name', __('admin.form.Region name'));
        // $grid->column('class_code', __('admin.form.Category code'));
        
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
        $show = new Show(Region::findOrFail($id));

        $show->field('id', 'ID');
        $show->field('name', __('admin.form.Region name'));

        $show->departments(__('admin.form.Departments'), function ($departments) {
            $departments->resource('/admin/departments');

            // Add filter by name
            $departments->filter(function ($filter) {
                $filter->disableIdFilter();
                $filter->like('name', __('admin.form.Department name'));
            });

            $departments->id('ID')->sortable();
            $departments->name(__('admin.form.Department name'));
            $departments->code(__('admin.form.Department code'));
            $departments->created_at(__('admin.form.Created at'))->display(function ($created_at) {
                return date('d-m-Y H:i:s', strtotime($created_at));
            });;

            // Disable the "Create" button
            $departments->disableCreateButton();

            // Disable row actions (Edit, Delete)
            $departments->disableActions();
            $departments->disableExport();

            // Disable batch actions (Bulk delete, etc.)
            $departments->disableBatchActions();
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
        $form = new Form(new Region());

        $form = new Form(new Region());

        $form->text('name', __('admin.form.Region name'))->rules('required');

        $form->hasMany('departments', function (Form\NestedForm $form) {
            $form->text('name', __('admin.form.Department name'))->rules('required');
            $form->text('code', __('admin.form.Department code'))->rules('required');
        });

        return $form;
    }
}
