<?php

namespace App\Admin\Controllers;

use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use \App\Models\CooperativeMember;
use \Encore\Admin\Facades\Admin;


class CooperativeMemberController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'CooperativeMember';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new CooperativeMember());

        $grid->column('member_number', __('Member number'));
        $grid->column('farmer_first_name', __('Farmer first name'));
        $grid->column('farmer_last_name', __('Farmer last name'));
        $grid->column('phone_number', __('Phone number'));
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
        $show = new Show(CooperativeMember::findOrFail($id));

        $show->field('member_number', __('Member number'));
        $show->field('farmer_first_name', __('Farmer first name'));
        $show->field('farmer_last_name', __('Farmer last name'));
        $show->field('gender', __('Gender'));
        $show->field('date_of_birth', __('Date of birth'));
        $show->field('nationality', __('Nationality'));
        $show->field('phone_number', __('Phone number'));
        $show->field('email_address', __('Email address'));
        $show->field('residential_physical_address', __('Residential physical address'));
        $show->field('agriculture_value_chains', __('Agriculture value chains'));
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
        $form = new Form(new CooperativeMember());

        //get the cooperative id of the user
        $user = Admin::user()->id;
        $cooperative_id = \App\Models\Cooperative::where('user_id', $user)->first()->id;
        $form->hidden('cooperative_id', __('Cooperative id'))->default($cooperative_id)->readonly();
        $form->text('member_number', __('Member number'))->default(rand(1000, 100000))->required();
        $form->text('farmer_first_name', __('Farmer first name'));
        $form->text('farmer_last_name', __('Farmer last name'));
        $form->select('gender', __('Gender'))->options(['Male' => 'Male', 'Female' => 'Female', 'Other' => 'Other']);
        $form->date('date_of_birth', __('Date of birth'))->default(date('Y-m-d'));
        $form->text('nationality', __('Nationality'));
        $form->text('phone_number', __('Phone number'));
        $form->text('email_address', __('Email address'));
        $form->text('residential_physical_address', __('Residential physical address'));
        $form->text('agriculture_value_chains', __('Agriculture value chains'));

        return $form;
    }
}
