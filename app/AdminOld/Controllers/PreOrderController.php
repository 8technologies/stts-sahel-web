<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
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
        $grid->column('order_number', __('Order number'));
        $grid->column('crop', __('Crop'));
        $grid->column('variety', __('Variety'));
        $grid->column('seed_class', __('Seed class'));
        $grid->column('quantity', __('Quantity'));
        $grid->column('preferred_delivery_date', __('Preferred delivery date'));
        $grid->column('order_date', __('Order date'));
        $grid->column('client_name', __('Client name'));
        $grid->column('client_physical_address', __('Client physical address'));
        $grid->column('client_contact_number', __('Client contact number'));
        $grid->column('client_email_address', __('Client email address'));
        $grid->column('preferred_payment_method', __('Preferred payment method'));
        $grid->column('proof_of_payment', __('Proof of payment'));
        $grid->column('seed_delivery_preferences', __('Seed delivery preferences'));
        $grid->column('other_information', __('Other information'));
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
        $show = new Show(PreOrder::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('order_number', __('Order number'));
        $show->field('crop', __('Crop'));
        $show->field('variety', __('Variety'));
        $show->field('seed_class', __('Seed class'));
        $show->field('quantity', __('Quantity'));
        $show->field('preferred_delivery_date', __('Preferred delivery date'));
        $show->field('order_date', __('Order date'));
        $show->field('client_name', __('Client name'));
        $show->field('client_physical_address', __('Client physical address'));
        $show->field('client_contact_number', __('Client contact number'));
        $show->field('client_email_address', __('Client email address'));
        $show->field('preferred_payment_method', __('Preferred payment method'));
        $show->field('proof_of_payment', __('Proof of payment'));
        $show->field('seed_delivery_preferences', __('Seed delivery preferences'));
        $show->field('other_information', __('Other information'));
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
        $form = new Form(new PreOrder());

        $form->text('order_number', __('Order number'));
        $form->text('crop', __('Crop'));
        $form->text('variety', __('Variety'));
        $form->text('seed_class', __('Seed class'));
        $form->decimal('quantity', __('Quantity'));
        $form->date('preferred_delivery_date', __('Preferred delivery date'))->default(date('Y-m-d'));
        $form->date('order_date', __('Order date'))->default(date('Y-m-d'));
        $form->text('client_name', __('Client name'));
        $form->text('client_physical_address', __('Client physical address'));
        $form->text('client_contact_number', __('Client contact number'));
        $form->text('client_email_address', __('Client email address'));
        $form->text('preferred_payment_method', __('Preferred payment method'));
        $form->text('proof_of_payment', __('Proof of payment'));
        $form->text('seed_delivery_preferences', __('Seed delivery preferences'));
        $form->textarea('other_information', __('Other information'));

        return $form;
    }
}
