<?php

namespace App\Admin\Controllers;

use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use \App\Models\Cooperative;

class CooperativeController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Cooperative';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Cooperative());

        $grid->column('id', __('Id'));
        $grid->column('cooperative_number', __('Cooperative number'));
        $grid->column('cooperative_name', __('Cooperative name'));
        $grid->column('registration_number', __('Registration number'));
        $grid->column('membership_type', __('Membership type'));
       

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
        $show = new Show(Cooperative::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('cooperative_number', __('Cooperative number'));
        $show->field('cooperative_name', __('Cooperative name'));
        $show->field('registration_number', __('Registration number'));
        $show->field('cooperative_physical_address', __('Cooperative physical address'));
        $show->field('contact_person_name', __('Contact person name'));
        $show->field('contact_phone_number', __('Contact phone number'));
        $show->field('contact_email', __('Contact email'));
        $show->field('membership_type', __('Membership type'));
        $show->field('services_to_members', __('Services to members'));
        $show->field('objectives_or_goals', __('Objectives or goals'));
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
        $form = new Form(new Cooperative());

        $form->text('cooperative_number', __('Cooperative number'));
        $form->text('cooperative_name', __('Cooperative name'));
        $form->text('registration_number', __('Registration number'));
        $form->text('cooperative_physical_address', __('Cooperative physical address'));
        $form->text('contact_person_name', __('Contact person name'));
        $form->text('contact_phone_number', __('Contact phone number'));
        $form->text('contact_email', __('Contact email'));
        $form->text('membership_type', __('Membership type'));
        $form->text('services_to_members', __('Services to members'));
        $form->text('objectives_or_goals', __('Objectives or goals'));
        //has many users
        $form->hasMany('members', 'Cooperative members', function (Form\NestedForm $form) {
            $form->text('first_name', 'Farmer first name');
            $form->text('last_name', 'Farmer last name');
            $form->radio('gender', 'Gender')->options(['m' => 'Female', 'f'=> 'Male']);
            $form->date('date_of_birth', 'Date of birth');
            $form->text('nationality', 'Nationality');
            $form->text('email', 'Email');
            $form->text('phone_number', 'Phone number');
            $form->text('address', 'Resendential address');
            $form->text('value_chains', 'Agricultural value chains');
           
        });

        return $form;
    }
}
