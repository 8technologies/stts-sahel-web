<?php

namespace App\Admin\Controllers;

use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use \App\Models\MarketableSeed;
use Encore\Admin\Facades\Admin;

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
      //order
        $grid->model()->orderBy('id', 'desc');

        //show a user only what belongs to him if he is not an admin
        if (!Admin::user()->isRole('commissioner')) {
            $grid->model()->where('user_id', Admin::user()->id);
        }

        //disable creation of new records
        $grid->disableCreateButton();
        //disable delete and edit buttons only
        $grid->actions(function ($actions) {
            $actions->disableDelete();
            $actions->disableEdit();
        });
        $grid->column('id', __('Id'));
        $grid->column('user_id', __('User'))->display(function($user_id){
            return \App\Models\User::find($user_id)->name;
        });
        $grid->column('crop_variety_id', __('Crop variety'))->display(function($crop_variety_id){
            return \App\Models\CropVariety::find($crop_variety_id)->crop_variety_name;
        });
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

    
        $show->field('user_id', __('User'))->as(function($user_id){
            return \App\Models\User::find($user_id)->name;
        });
        $show->field('seed_lab_id', __('Seed lab number'))->as(function($seed_lab_id){
            return \App\Models\SeedLab::find($seed_lab_id)->seed_lab_test_report_number;
        });
        $show->field('load_stock_id', __('Load stock number'))->as(function($load_stock_id){
            return \App\Models\LoadStock::find($load_stock_id)->load_stock_number;
        });
        $show->field('crop_variety_id', __('Crop variety'))->as(function($crop_variety_id){
            return \App\Models\CropVariety::find($crop_variety_id)->crop_variety_name;
        });
        $show->field('quantity', __('Quantity'));
        $show->field('created_at', __('Created at'));
       

        //disable edit and delete buttons
        $show->panel()->tools(function ($tools) {
            $tools->disableEdit();
            $tools->disableDelete();
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
        $form = new Form(new MarketableSeed());

        $form->number('user_id', __('User id'));
        $form->number('seed_lab_id', __('Seed lab id'));
        $form->number('load_stock_id', __('Load stock id'));
        $form->number('crop_variety_id', __('Crop variety id'));
        $form->number('quantity', __('Quantity'));

        return $form;
    }
}
