<?php

namespace App\Admin\Controllers;

use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use \App\Models\MarketableSeed;

class MarketableSeedController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'MarketableSeed';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new MarketableSeed());

        $grid->column('id', __('Id'));
        $grid->column('user_id', __('User id'));
        $grid->column('seed_lab_id', __('Seed lab id'));
        $grid->column('load_stock_id', __('Load stock id'));
        $grid->column('crop_variety_id', __('Crop variety id'));
        $grid->column('quantity', __('Quantity'));
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
        $show = new Show(MarketableSeed::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('user_id', __('User id'));
        $show->field('seed_lab_id', __('Seed lab id'));
        $show->field('load_stock_id', __('Load stock id'));
        $show->field('crop_variety_id', __('Crop variety id'));
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
        $form = new Form(new MarketableSeed());

        $form->number('user_id', __('User id'));
        $form->number('seed_lab_id', __('Seed lab id'));
        $form->number('load_stock_id', __('Load stock id'));
        $form->number('crop_variety_id', __('Crop variety id'));
        $form->number('quantity', __('Quantity'));

        return $form;
    }
}
