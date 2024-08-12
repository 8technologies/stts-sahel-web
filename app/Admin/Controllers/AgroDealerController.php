<?php

namespace App\Admin\Controllers;

use App\Models\AgroDealers;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class AgroDealerController extends AdminController
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
        $grid->column('user_id', __('User id'));
        $grid->column('agro_dealer_reg_number', __('Agro dealer reg number'));
        $grid->column('first_name', __('First name'));
        $grid->column('last_name', __('Last name'));
        $grid->column('email', __('Email'));
        $grid->column('physical_address', __('Physical address'));
        $grid->column('district', __('District'));
        $grid->column('circle', __('Circle'));
        $grid->column('township', __('Township'));
        $grid->column('town_plot_number', __('Town plot number'));
        $grid->column('shop_number', __('Shop number'));
        $grid->column('company_name', __('Company name'));
        $grid->column('retailers_in', __('Retailers in'));
        $grid->column('business_registration_number', __('Business registration number'));
        $grid->column('years_in_operation', __('Years in operation'));
        $grid->column('business_description', __('Business description'));
        $grid->column('trading_license_number', __('Trading license number'));
        $grid->column('trading_license_period', __('Trading license period'));
        $grid->column('insuring_authority', __('Insuring authority'));
        $grid->column('attachments_certificate', __('Attachments certificate'));
        $grid->column('proof_of_payment', __('Proof of payment'));
        $grid->column('status', __('Status'));
        $grid->column('status_comment', __('Status comment'));
        $grid->column('valid_from', __('Valid from'));
        $grid->column('valid_until', __('Valid until'));
        $grid->column('inspector_id', __('Inspector id'));
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
        $show->field('user_id', __('User id'));
        $show->field('agro_dealer_reg_number', __('Agro dealer reg number'));
        $show->field('first_name', __('First name'));
        $show->field('last_name', __('Last name'));
        $show->field('email', __('Email'));
        $show->field('physical_address', __('Physical address'));
        $show->field('district', __('District'));
        $show->field('circle', __('Circle'));
        $show->field('township', __('Township'));
        $show->field('town_plot_number', __('Town plot number'));
        $show->field('shop_number', __('Shop number'));
        $show->field('company_name', __('Company name'));
        $show->field('retailers_in', __('Retailers in'));
        $show->field('business_registration_number', __('Business registration number'));
        $show->field('years_in_operation', __('Years in operation'));
        $show->field('business_description', __('Business description'));
        $show->field('trading_license_number', __('Trading license number'));
        $show->field('trading_license_period', __('Trading license period'));
        $show->field('insuring_authority', __('Insuring authority'));
        $show->field('attachments_certificate', __('Attachments certificate'));
        $show->field('proof_of_payment', __('Proof of payment'));
        $show->field('status', __('Status'));
        $show->field('status_comment', __('Status comment'));
        $show->field('valid_from', __('Valid from'));
        $show->field('valid_until', __('Valid until'));
        $show->field('inspector_id', __('Inspector id'));
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

        $form->number('user_id', __('User id'));
        $form->text('agro_dealer_reg_number', __('Agro dealer reg number'));
        $form->text('first_name', __('First name'));
        $form->text('last_name', __('Last name'));
        $form->email('email', __('Email'));
        $form->text('physical_address', __('Physical address'));
        $form->text('district', __('District'));
        $form->text('circle', __('Circle'));
        $form->text('township', __('Township'));
        $form->text('town_plot_number', __('Town plot number'));
        $form->text('shop_number', __('Shop number'));
        $form->text('company_name', __('Company name'));
        $form->text('retailers_in', __('Retailers in'));
        $form->text('business_registration_number', __('Business registration number'));
        $form->number('years_in_operation', __('Years in operation'));
        $form->textarea('business_description', __('Business description'));
        $form->text('trading_license_number', __('Trading license number'));
        $form->text('trading_license_period', __('Trading license period'));
        $form->text('insuring_authority', __('Insuring authority'));
        $form->text('attachments_certificate', __('Attachments certificate'));
        $form->text('proof_of_payment', __('Proof of payment'));
        $form->text('status', __('Status'))->default('pending');
        $form->text('status_comment', __('Status comment'));
        $form->text('valid_from', __('Valid from'));
        $form->text('valid_until', __('Valid until'));
        $form->number('inspector_id', __('Inspector id'));

        return $form;
    }
}
