<?php

namespace App\Admin\Controllers;

use App\Models\OutGrower;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class OuGrowerController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'OutGrower';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new OutGrower());

        $grid->column('seed_company_registration_number', __('Seed company registration number'));
        $grid->column('first_name', __('First name'));
        $grid->column('last_name', __('Last name'));
        $grid->column('phone_number', __('Phone number'));
        $grid->column('gender', __('Gender'));
        $grid->column('email_address', __('Email address'));
    
       
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
        $show = new Show(OutGrower::findOrFail($id));

        $show->field('contract_number', __('Contract number'));
        $show->field('seed_company_name', __('Seed company name'));
        $show->field('seed_company_registration_number', __('Seed company registration number'));
        $show->field('first_name', __('First name'));
        $show->field('last_name', __('Last name'));
        $show->field('phone_number', __('Phone number'));
        $show->field('gender', __('Gender'));
        $show->field('email_address', __('Email address'));
        $show->field('district', __('District'));
        $show->field('sub_county', __('Sub county'));
        $show->field('town_street', __('Town street'));
        $show->field('plot_number', __('Plot number'));
        $show->field('valid_from', __('Valid from'));
        $show->field('valid_to', __('Valid to'));
        $show->field('signature', __('Signature'));
       

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new OutGrower());
        //find the aunthenticated user id
        $user_id = auth()->user()->id;
        //find the seed company id of the authenticated user
        $seed_company= \App\Models\SeedProducer::where('user_id', $user_id)->first();
        
        $form->hidden('seed_company_id')->value($seed_company->id);

        $form->text('contract_number', __('Contract number'));
        $form->text('seed_company_name', __('Seed company name'))->value($seed_company->name_of_applicant);
        $form->text('seed_company_registration_number', __('Seed company registration number'))->value($seed_company->producer_registration_number);
        $form->text('first_name', __('First name'));
        $form->text('last_name', __('Last name'));
        $form->text('phone_number', __('Phone number'));
        $form->text('gender', __('Gender'));
        $form->text('email_address', __('Email address'));
        $form->text('district', __('District'));
        $form->text('sub_county', __('Sub county'));
        $form->text('town_street', __('Town street'));
        $form->text('plot_number', __('Plot number'));
        $form->date('valid_from', __('Valid from'))->default(date('Y-m-d'));
        $form->date('valid_to', __('Valid to'))->default(date('Y-m-d'));
        $form->text('signature', __('Signature'));

        return $form;
    }
}
