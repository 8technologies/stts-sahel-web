<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\Cooperatives;

class CooperativesController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Cooperatives';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Cooperatives());

        $grid->column('id', __('Id'));
        $grid->column('cooperative_number', __('Cooperative number'));
        $grid->column('cooperative_name', __('Cooperative name'));
        $grid->column('registration_number', __('Registration number'));
        $grid->column('cooperative_physical_address', __('Cooperative physical address'));
        $grid->column('contact_person_name', __('Contact person name'));
        $grid->column('contact_phone_number', __('Contact phone number'));
        $grid->column('contact_email', __('Contact email'));
        $grid->column('membership_type', __('Membership type'));
        $grid->column('services_to_members', __('Services to members'));
        $grid->column('objectives_or_goals', __('Objectives or goals'));
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
        $show = new Show(Cooperatives::findOrFail($id));

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
        $form = new Form(new Cooperatives());

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

        return $form;
    }
}
