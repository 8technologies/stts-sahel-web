<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\SeedLabTestReport;

class SeedLabTestReportController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'SeedLabTestReport';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new SeedLabTestReport());

        $grid->column('id', __('Id'));
        $grid->column('seed_lab_test_report_number', __('Seed lab test report number'));
        $grid->column('seed_sample_request_number', __('Seed sample request number'));
        $grid->column('planting_return_id', __('Planting return id'));
        $grid->column('applicant_name', __('Applicant name'));
        $grid->column('seed_sample_size', __('Seed sample size'));
        $grid->column('testing_methods', __('Testing methods'));
        $grid->column('germination_test_results', __('Germination test results'));
        $grid->column('purity_test_results', __('Purity test results'));
        $grid->column('moisture_content_test_results', __('Moisture content test results'));
        $grid->column('additional_tests_results', __('Additional tests results'));
        $grid->column('test_decision', __('Test decision'));
        $grid->column('reporting_and_signature', __('Reporting and signature'));
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
        $show = new Show(SeedLabTestReport::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('seed_lab_test_report_number', __('Seed lab test report number'));
        $show->field('seed_sample_request_number', __('Seed sample request number'));
        $show->field('planting_return_id', __('Planting return id'));
        $show->field('applicant_name', __('Applicant name'));
        $show->field('seed_sample_size', __('Seed sample size'));
        $show->field('testing_methods', __('Testing methods'));
        $show->field('germination_test_results', __('Germination test results'));
        $show->field('purity_test_results', __('Purity test results'));
        $show->field('moisture_content_test_results', __('Moisture content test results'));
        $show->field('additional_tests_results', __('Additional tests results'));
        $show->field('test_decision', __('Test decision'));
        $show->field('reporting_and_signature', __('Reporting and signature'));
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
        $form = new Form(new SeedLabTestReport());

        $form->text('seed_lab_test_report_number', __('Seed lab test report number'));
        $form->text('seed_sample_request_number', __('Seed sample request number'));
        $form->text('planting_return_id', __('Planting return id'));
        $form->text('applicant_name', __('Applicant name'));
        $form->decimal('seed_sample_size', __('Seed sample size'));
        $form->text('testing_methods', __('Testing methods'));
        $form->decimal('germination_test_results', __('Germination test results'));
        $form->decimal('purity_test_results', __('Purity test results'));
        $form->decimal('moisture_content_test_results', __('Moisture content test results'));
        $form->textarea('additional_tests_results', __('Additional tests results'));
        $form->text('test_decision', __('Test decision'));
        $form->textarea('reporting_and_signature', __('Reporting and signature'));

        return $form;
    }
}
