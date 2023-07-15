<?php

namespace App\Admin\Controllers;

use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use \App\Models\PreOrder;

class PreOrderController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'PreOrder';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new PreOrder());

        $grid->column('id', __('Id'));
        $grid->column('crop_variety_id', __('Crop variety'))->display(function($crop_variety_id){
            return \App\Models\CropVariety::find($crop_variety_id)->crop_variety_name;
        });
        $grid->column('seed_class', __('Seed class'));
        $grid->column('quantity', __('Quantity'));
        $grid->column('preferred_delivery_date', __('Preferred delivery date'));
        $grid->column('client_name', __('Client name'));
       

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
        $show = new Show(PreOrder::findOrFail($id));

    
        $show->field('crop_variety_id', __('Crop variety'))->as(function($crop_variety_id){
            return \App\Models\CropVariety::find($crop_variety_id)->crop_variety_name;
        });
        $show->field('seed_class', __('Seed class'));
        $show->field('quantity', __('Quantity'));
        $show->field('preferred_delivery_date', __('Preferred delivery date'));
        $show->field('order_date', __('Order date'));
        $show->field('client_name', __('Client name'));
        $show->field('client_physical_address', __('Client physical address'));
        $show->field('client_contact_number', __('Client contact number'));
        $show->field('client_email_address', __('Client email address'));
        $show->field('preferred_payment_method', __('Preferred payment method'));
        $show->field('seed_delivery_preferences', __('Seed delivery preferences'));
        $show->field('other_information', __('Other information'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        //disable delete button
        $show->panel()->tools(function ($tools) {
            $tools->disableDelete();
            $tools->disableEdit();
            $tools->disableList();

            //check if the user is not the owner of the pre-order
            $user = auth()->user();
            $id = request()->route()->parameters['pre_order'];
            $preOrder = PreOrder::findOrFail($id);
            if($user->id != $preOrder->user_id) {
                $tools->append("<a href='" . admin_url('quotations/create?preorder_id='.$id) . "' class='btn btn-primary'>SUBMIT QUOTATION</a>");
            }
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
        $form = new Form(new PreOrder());

        //assign user_id to the currently logged in user
        $user = auth()->user();
        if($form->isCreating()) {
            $form->hidden('user_id')->default($user->id);
        }
        $form->select('crop_variety_id', __('Crop variety'))->options(\App\Models\CropVariety::all()->pluck('crop_variety_name', 'id'));
        $form->text('seed_class', __('Seed class'));
        $form->decimal('quantity', __('Quantity'));
        $form->date('preferred_delivery_date', __('Preferred delivery date'))->default(date('Y-m-d'));
        $form->date('order_date', __('Order date'))->default(date('Y-m-d'));
        $form->text('client_name', __('Client name'));
        $form->text('client_physical_address', __('Client physical address'));
        $form->text('client_contact_number', __('Client contact number'));
        $form->text('client_email_address', __('Client email address'));
        $form->text('preferred_payment_method', __('Preferred payment method'));
        $form->text('seed_delivery_preferences', __('Seed delivery preferences'));
        $form->textarea('other_information', __('Other information'));

        

        return $form;
    }
}
