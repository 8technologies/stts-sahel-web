<?php

namespace App\Admin\Controllers;

use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use \App\Models\Utils;
use \App\Models\MarketableSeed;


class MarketableSeedController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected function title()
    {
        return trans('admin.form.Marketable seed');
    }


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
       
        //disable creation of new records
        $grid->disableCreateButton();

         //disable batch and export actions
         Utils::disable_batch_actions($grid);
       
        //if the marketable seed is not made by the user,disable the delete and edit button
        $grid->actions(function ($actions) {
            $user = auth()->user()->id;
            $owner = ((int)(($actions->row['user_id'])));
            if ($owner != $user) {
                $actions->disableDelete();
               
            }
            else{
                $actions->disableDelete();
            }
        });
   
        $grid->column('user_id', __('admin.form.User'))->display(function($user_id){
            return \App\Models\User::find($user_id)->name;
        });
        $grid->column('crop_variety_id', __('admin.form.Crop Variety'))->display(function($crop_variety_id){
            return \App\Models\CropVariety::find($crop_variety_id)->crop_variety_name;
        });
        $grid->column('quantity', __('admin.form.Quantity(kgs)'))->display(function($quantity){
            return $quantity.' kgs';
        });
        $grid->column('created_at', __('admin.form.Created at'));

        //place order button
        $grid->column('id', __('Place Order'))->display(function ($id) 
        {
            //check if the authenticated user is the owner of the marketable seed
            $user = auth()->user()->id;
            $stock_quantity = ((int)(($this->quantity)));
            $owner = ((int)(($this->user_id)));
            if ($owner != $user && $stock_quantity > 0) {
                return "<a href='" . admin_url('orders/create?marketable_id=' . $id) . "' class='btn btn-primary'>Place Order</a>";
            }
        
        })->sortable();
          
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

    
        $show->field('user_id', __('admin.form.User'))->as(function($user_id){
            return \App\Models\User::find($user_id)->name;
        });
        $show->field('seed_lab_id', __('admin.form.Seed lab number'))->as(function($seed_lab_id){
            return \App\Models\SeedLab::find($seed_lab_id)->seed_lab_test_report_number;
        });
        $show->field('load_stock_id', __('admin.form.Load stock number'))->as(function($load_stock_id){
            return \App\Models\LoadStock::find($load_stock_id)->load_stock_number;
        });
        $show->field('crop_variety_id', __('admin.form.Crop Variety'))->as(function($crop_variety_id){
            return \App\Models\CropVariety::find($crop_variety_id)->crop_variety_name;
        });
        $show->field('quantity', __('admin.form.Quantity(kgs)'))->as(function($quantity){
            return $quantity.' kgs';
        });
        $show->field('created_at', __('admin.form.Created at'));
       

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

        $form->number('user_id', __('admin.form.User id'));
        $form->number('seed_lab_id', __('admin.form.Seed lab id'));
        $form->number('load_stock_id', __('admin.form.Load stock id'));
        $form->number('crop_variety_id', __('admin.form.Crop variety id'));
        $form->number('quantity', __('admin.form.Quantity'));

        return $form;
    }
}
