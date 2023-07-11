<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\CertificationForm;

class CertificationFormController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'CertificationForm';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new CertificationForm());

        $grid->column('id', __('Id'));
        $grid->column('first_name', __('First name'));
        $grid->column('last_name', __('Last name'));
        $grid->column('other_name', __('Other name'));
        $grid->column('applicants_registration_number', __('Applicants registration number'));
        $grid->column('applicants_contact', __('Applicants contact'));
        $grid->column('category', __('Category'));
        $grid->column('certification_type', __('Certification type'));
        $grid->column('validity_period', __('Validity period'));
        $grid->column('application_details', __('Application details'));
        $grid->column('assessment_evaluation', __('Assessment evaluation'));
        $grid->column('supporting_documents', __('Supporting documents'));
        $grid->column('declaration_agreement', __('Declaration agreement'));
        $grid->column('signature', __('Signature'));
        $grid->column('date', __('Date'));
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
        $show = new Show(CertificationForm::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('first_name', __('First name'));
        $show->field('last_name', __('Last name'));
        $show->field('other_name', __('Other name'));
        $show->field('applicants_registration_number', __('Applicants registration number'));
        $show->field('applicants_contact', __('Applicants contact'));
        $show->field('category', __('Category'));
        $show->field('certification_type', __('Certification type'));
        $show->field('validity_period', __('Validity period'));
        $show->field('application_details', __('Application details'));
        $show->field('assessment_evaluation', __('Assessment evaluation'));
        $show->field('supporting_documents', __('Supporting documents'));
        $show->field('declaration_agreement', __('Declaration agreement'));
        $show->field('signature', __('Signature'));
        $show->field('date', __('Date'));
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
        $form = new Form(new CertificationForm());

        $form->text('first_name', __('First name'));
        $form->text('last_name', __('Last name'));
        $form->text('other_name', __('Other name'));
        $form->text('applicants_registration_number', __('Applicants registration number'));
        $form->text('applicants_contact', __('Applicants contact'));
        $form->text('category', __('Category'));
        $form->text('certification_type', __('Certification type'));
        $form->date('validity_period', __('Validity period'))->default(date('Y-m-d'));
        $form->textarea('application_details', __('Application details'));
        $form->textarea('assessment_evaluation', __('Assessment evaluation'));
        $form->textarea('supporting_documents', __('Supporting documents'));
        $form->switch('declaration_agreement', __('Declaration agreement'));
        $form->text('signature', __('Signature'));
        $form->date('date', __('Date'))->default(date('Y-m-d'));

        return $form;
    }
}
