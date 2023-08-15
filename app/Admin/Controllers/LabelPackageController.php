<?php

namespace App\Admin\Controllers;

use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use \App\Models\LabelPackage;
use \App\Models\SeedClass;

class LabelPackageController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'LabelPackage';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new LabelPackage());

        //order by quantity
        $grid->model()->orderBy('quantity', 'asc');

        $grid->column('package_type', __('Package Type'));
        $grid->column('seed_generation', __('Seed Generation'))->display(function ($value) {
            return SeedClass::find($value)->class_name ?? '-';
        });
        $grid->column('price', __('Price'));
        $grid->column('quantity', __('Quantity'));
       

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
        $show = new Show(LabelPackage::findOrFail($id));

        $show->field('package_type', __('Package Type'));
        $show->field('seed_generation', __('Seed Generation'))->as(function ($value) {
            return SeedClass::find($value)->class_name ?? '-';
        });
        $show->field('price', __('Price'));
        $show->field('quantity', __('Quantity'));
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
        $form = new Form(new LabelPackage());

        $form->text('package_type', __('Package Type'))->required();
        $form->select('seed_generation', __('Seed Generation'))->options(\App\Models\SeedClass::all()->pluck('class_name', 'id'));
        $form->text('quantity', __('Quantity'))->attribute( 
            [
                'type' => 'number',
                'step' => 'any'
            ]
        )
        ->required();
        $form->text('price', __('Price'))->attribute( 
            [
                'type' => 'number',
                'step' => 'any'
            ]
        )
        ->required();

        return $form;
    }
}
