<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\OutGrowerContract;

class OutGrowerContractController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'OutGrowerContract';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new OutGrowerContract());

        $grid->column('id', __('Id'));
        $grid->column('contract_number', __('Contract number'));
        $grid->column('seed_company_name', __('Seed company name'));
        $grid->column('seed_company_registration_number', __('Seed company registration number'));
        $grid->column('out_grower_first_name', __('Out grower first name'));
        $grid->column('out_grower_last_name', __('Out grower last name'));
        $grid->column('phone_number', __('Phone number'));
        $grid->column('gender', __('Gender'));
        $grid->column('email', __('Email'));
        $grid->column('district', __('District'));
        $grid->column('sub_county', __('Sub county'));
        $grid->column('town', __('Town'));
        $grid->column('plot_number', __('Plot number'));
        $grid->column('contract_details', __('Contract details'));
        $grid->column('start_date', __('Start date'));
        $grid->column('end_date', __('End date'));
        $grid->column('out_grower_signature', __('Out grower signature'));
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
        $show = new Show(OutGrowerContract::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('contract_number', __('Contract number'));
        $show->field('seed_company_name', __('Seed company name'));
        $show->field('seed_company_registration_number', __('Seed company registration number'));
        $show->field('out_grower_first_name', __('Out grower first name'));
        $show->field('out_grower_last_name', __('Out grower last name'));
        $show->field('phone_number', __('Phone number'));
        $show->field('gender', __('Gender'));
        $show->field('email', __('Email'));
        $show->field('district', __('District'));
        $show->field('sub_county', __('Sub county'));
        $show->field('town', __('Town'));
        $show->field('plot_number', __('Plot number'));
        $show->field('contract_details', __('Contract details'));
        $show->field('start_date', __('Start date'));
        $show->field('end_date', __('End date'));
        $show->field('out_grower_signature', __('Out grower signature'));
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
        $form = new Form(new OutGrowerContract());

        $form->text('contract_number', __('Contract number'));
        $form->text('seed_company_name', __('Seed company name'));
        $form->text('seed_company_registration_number', __('Seed company registration number'));
        $form->text('out_grower_first_name', __('Out grower first name'));
        $form->text('out_grower_last_name', __('Out grower last name'));
        $form->text('phone_number', __('Phone number'));
        $form->text('gender', __('Gender'));
        $form->email('email', __('Email'));
        $form->text('district', __('District'));
        $form->text('sub_county', __('Sub county'));
        $form->text('town', __('Town'));
        $form->number('plot_number', __('Plot number'));
        $form->textarea('contract_details', __('Contract details'));
        $form->date('start_date', __('Start date'))->default(date('Y-m-d'));
        $form->date('end_date', __('End date'))->default(date('Y-m-d'));
        $form->text('out_grower_signature', __('Out grower signature'));

        return $form;
    }
}
