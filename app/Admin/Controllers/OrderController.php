<?php

namespace App\Admin\Controllers;

use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use \App\Models\Order;
use \App\Models\PreOrder;
use \App\Models\Quotation;
use \App\Models\Utils;
use \App\Models\User;
use Encore\Admin\Facades\Admin;

class OrderController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Order';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Order());

        //disable create button 
        
        $grid->disableCreateButton();

    
        //check if the user is the one who made the order and disable the edit button
        $grid->actions(function ($actions) {
            if ($actions->row->order_by == Admin::user()->id) {
                $actions->disableEdit();
                $actions->disableDelete();
            }else{
               
                $actions->disableDelete();
            }
           
        });


        //only view orders made by you or to you
        $grid->model()->where('order_by', '=', Admin::user()->id)->orWhere('supplier', '=', Admin::user()->id);

        $grid->column('order_number', __('Order number'));
        $grid->column('preorder_id', __('Crop variety'))->display(function ($preorder_id) 
        {
            $crop_variety_id = PreOrder::find($preorder_id)->crop_variety_id;
            return \App\Models\CropVariety::find($crop_variety_id)->crop_variety_name;
        });
        $grid->column('quantity', __('Quantity'));
        $grid->column('price', __('Price'));
        $grid->column('order_date', __('Order date'));
        $grid->column('supply_date', __('Supply date'));
        $grid->column('order_by', __('Order by'))->display(function ($order_by) 
        {
            return User::find($order_by)->name;
        });
        $grid->column('status', __('Status'))->display(function ($status) 
        {
            return Utils::tell_status($status)?? '-';
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
        $show = new Show(Order::findOrFail($id));

        $order = Order::find($id);
        $preOrder = PreOrder::find($order->preorder_id);
        
        $show->field('order_number', __('Order number'));
        $show->field('order_date', __('Order date'));

        $show->field('crop_variety_id', __('Crop variety'))->as(function () use ($preOrder)
        {
            return \App\Models\CropVariety::find($preOrder->crop_variety_id)->crop_variety_name;
        });
        $show->field('seed_class', __('Seed class'))->as(function () use ($preOrder)
        {
            return $preOrder->seed_class;
        });
    
        $show->field('quantity', __('Quantity to be supplied'));
        $show->field('price', __('Price'));
        $show->field('supply_date', __('Supply date'));
        $show->field('order_by', __('Order by'))->as(function ($order_by) 
        {
            return User::find($order_by)->name;
        });
        $show->field('details', __('Details'));
        $show->field('status', __('Status'));
     
      //disable action button
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
        $form = new Form(new Order());

        $form->display('order_number', __('Order number'));

        $form->display('order_by', __('Order by'))->with(function ($order_by) 
        {
            return User::find($order_by)->name;
        });

        $form->display('preorder_id', __('Crop Variety'))->with(function ($preorder_id) 
        {
            $crop_variety_id = PreOrder::find($preorder_id)->crop_variety_id;
            return \App\Models\CropVariety::find($crop_variety_id)->crop_variety_name;
        });
        
        $form->display('quantity', __('Quantity'));
        $form->display('price', __('Price'));
        $form->display('order_date', __('Order date'));
        $form->display('details', __('Details'));
        $form->radio('status', __('Status'))
        ->options([
            'processing' => 'Processing', 
            'shipping' => 'Shipping',
            'delivered' => 'Delivered',
            'canceled' => 'Canceled',
           ]);
        $form->text('status_comment', __('Comment'));
     
       

        //disable  action button
        $form->tools(function (Form\Tools $tools) {
            $tools->disableView();
            $tools->disableDelete();
        });

        return $form;
    }
}
