<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\SeedLabel;

class SeedLabelController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'SeedLabel';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new SeedLabel());

        $grid->column('id', __('Id'));
        $grid->column('seed_label_request_number', __('Seed label request number'));
        $grid->column('applicant_name', __('Applicant name'));
        $grid->column('registration_number', __('Registration number'));
        $grid->column('seed_lab_id', __('Seed lab id'));
        $grid->column('label_packages', __('Label packages'));
        $grid->column('quantity_of_seed', __('Quantity of seed'));
        $grid->column('proof_of_payment', __('Proof of payment'));
        $grid->column('request_date', __('Request date'));
        $grid->column('applicant_remarks', __('Applicant remarks'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        $grid->column('id', __('Label'))->display(function () {
            $link = url('label?id=' . $this->id);
            return '<b><a target="_blank" href="' . $link . '">Print Label</a></b>';
        });

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
        $show = new Show(SeedLabel::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('seed_label_request_number', __('Seed label request number'));
        $show->field('applicant_name', __('Applicant name'));
        $show->field('registration_number', __('Registration number'));
        $show->field('seed_lab_id', __('Seed lab id'));
        $show->field('label_packages', __('Label packages'));
        $show->field('quantity_of_seed', __('Quantity of seed'));
        $show->field('proof_of_payment', __('Proof of payment'));
        $show->field('request_date', __('Request date'));
        $show->field('applicant_remarks', __('Applicant remarks'));
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
        $form = new Form(new SeedLabel());

        $form->text('seed_label_request_number', __('Seed label request number'));
        $form->text('applicant_name', __('Applicant name'));
        $form->text('registration_number', __('Registration number'));
        $form->text('seed_lab_id', __('Seed lab id'));
        $form->text('label_packages', __('Label packages'));
        $form->decimal('quantity_of_seed', __('Quantity of seed'));
        $form->text('proof_of_payment', __('Proof of payment'));
        $form->date('request_date', __('Request date'))->default(date('Y-m-d'));
        $form->textarea('applicant_remarks', __('Applicant remarks'));

        return $form;
    }
}
