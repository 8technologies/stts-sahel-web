<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\AgroDealers;

class AgroDealersController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'AgroDealers';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new AgroDealers());

        $grid->column('id', __('Id'));
        $grid->column('agro_dealer_reg_number', __('Agro dealer reg number'));
        $grid->column('first_name', __('First name'));
        $grid->column('last_name', __('Last name'));
        $grid->column('email', __('Email'));
        $grid->column('physical_address', __('Physical address'));
        $grid->column('district', __('District'));
        $grid->column('sub_county', __('Sub county'));
        $grid->column('town_plot_number', __('Town plot number'));
        $grid->column('business_name', __('Business name'));
        $grid->column('dealers_in', __('Dealers in'));
        $grid->column('business_type', __('Business type'));
        $grid->column('business_registration_number', __('Business registration number'));
        $grid->column('years_in_operation', __('Years in operation'));
        $grid->column('business_description', __('Business description'));
        $grid->column('trading_license_info', __('Trading license info'));
        $grid->column('attachments_certificate', __('Attachments certificate'));
        $grid->column('proof_of_payment', __('Proof of payment'));
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
        $show = new Show(AgroDealers::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('agro_dealer_reg_number', __('Agro dealer reg number'));
        $show->field('first_name', __('First name'));
        $show->field('last_name', __('Last name'));
        $show->field('email', __('Email'));
        $show->field('physical_address', __('Physical address'));
        $show->field('district', __('District'));
        $show->field('sub_county', __('Sub county'));
        $show->field('town_plot_number', __('Town plot number'));
        $show->field('business_name', __('Business name'));
        $show->field('dealers_in', __('Dealers in'));
        $show->field('business_type', __('Business type'));
        $show->field('business_registration_number', __('Business registration number'));
        $show->field('years_in_operation', __('Years in operation'));
        $show->field('business_description', __('Business description'));
        $show->field('trading_license_info', __('Trading license info'));
        $show->field('attachments_certificate', __('Attachments certificate'));
        $show->field('proof_of_payment', __('Proof of payment'));
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
        $form = new Form(new AgroDealers());

        $form->text('agro_dealer_reg_number', __('Agro dealer reg number'));
        $form->text('first_name', __('First name'));
        $form->text('last_name', __('Last name'));
        $form->email('email', __('Email'));
        $form->text('physical_address', __('Physical address'));
        $form->text('district', __('District'));
        $form->text('sub_county', __('Sub county'));
        $form->text('town_plot_number', __('Town plot number'));
        $form->text('business_name', __('Business name'));
        $form->text('dealers_in', __('Dealers in'));
        $form->text('business_type', __('Business type'));
        $form->text('business_registration_number', __('Business registration number'));
        $form->number('years_in_operation', __('Years in operation'));
        $form->textarea('business_description', __('Business description'));
        $form->text('trading_license_info', __('Trading license info'));
        $form->text('attachments_certificate', __('Attachments certificate'));
        $form->text('proof_of_payment', __('Proof of payment'));

        return $form;
    }
}
