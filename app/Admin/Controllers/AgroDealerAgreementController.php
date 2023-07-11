<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\AgroDealerAgreement;

class AgroDealerAgreementController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'AgroDealerAgreement';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new AgroDealerAgreement());

        $grid->column('id', __('Id'));
        $grid->column('agro_dealer_agreement_number', __('Agro dealer agreement number'));
        $grid->column('first_name', __('First name'));
        $grid->column('last_name', __('Last name'));
        $grid->column('other_name', __('Other name'));
        $grid->column('legal_business_name', __('Legal business name'));
        $grid->column('contact_person', __('Contact person'));
        $grid->column('contact_phone_number', __('Contact phone number'));
        $grid->column('email_address', __('Email address'));
        $grid->column('physical_address', __('Physical address'));
        $grid->column('agreement_effective_date', __('Agreement effective date'));
        $grid->column('date_of_agreement', __('Date of agreement'));
        $grid->column('signed_by', __('Signed by'));
        $grid->column('agreement_term_or_duration', __('Agreement term or duration'));
        $grid->column('termination_clauses_and_conditions', __('Termination clauses and conditions'));
        $grid->column('confidentiality_obligations', __('Confidentiality obligations'));
        $grid->column('non_disclosure_agreements', __('Non disclosure agreements'));
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
        $show = new Show(AgroDealerAgreement::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('agro_dealer_agreement_number', __('Agro dealer agreement number'));
        $show->field('first_name', __('First name'));
        $show->field('last_name', __('Last name'));
        $show->field('other_name', __('Other name'));
        $show->field('legal_business_name', __('Legal business name'));
        $show->field('contact_person', __('Contact person'));
        $show->field('contact_phone_number', __('Contact phone number'));
        $show->field('email_address', __('Email address'));
        $show->field('physical_address', __('Physical address'));
        $show->field('agreement_effective_date', __('Agreement effective date'));
        $show->field('date_of_agreement', __('Date of agreement'));
        $show->field('signed_by', __('Signed by'));
        $show->field('agreement_term_or_duration', __('Agreement term or duration'));
        $show->field('termination_clauses_and_conditions', __('Termination clauses and conditions'));
        $show->field('confidentiality_obligations', __('Confidentiality obligations'));
        $show->field('non_disclosure_agreements', __('Non disclosure agreements'));
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
        $form = new Form(new AgroDealerAgreement());

        $form->text('agro_dealer_agreement_number', __('Agro dealer agreement number'));
        $form->text('first_name', __('First name'));
        $form->text('last_name', __('Last name'));
        $form->text('other_name', __('Other name'));
        $form->text('legal_business_name', __('Legal business name'));
        $form->text('contact_person', __('Contact person'));
        $form->text('contact_phone_number', __('Contact phone number'));
        $form->text('email_address', __('Email address'));
        $form->text('physical_address', __('Physical address'));
        $form->date('agreement_effective_date', __('Agreement effective date'))->default(date('Y-m-d'));
        $form->date('date_of_agreement', __('Date of agreement'))->default(date('Y-m-d'));
        $form->text('signed_by', __('Signed by'));
        $form->number('agreement_term_or_duration', __('Agreement term or duration'));
        $form->textarea('termination_clauses_and_conditions', __('Termination clauses and conditions'));
        $form->textarea('confidentiality_obligations', __('Confidentiality obligations'));
        $form->textarea('non_disclosure_agreements', __('Non disclosure agreements'));

        return $form;
    }
}
