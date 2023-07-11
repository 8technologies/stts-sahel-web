<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\SeedSamplingRequest;

class SeedSamplingRequestController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'SeedSamplingRequest';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new SeedSamplingRequest());

        $grid->column('id', __('Id'));
        $grid->column('sample_request_number', __('Sample request number'));
        $grid->column('applicant_id', __('Applicant id'));
        $grid->column('load_stock_number', __('Load stock number'));
        $grid->column('sample_request_date', __('Sample request date'));
        $grid->column('proof_of_payment', __('Proof of payment'));
        $grid->column('applicant_remarks', __('Applicant remarks'));
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
        $show = new Show(SeedSamplingRequest::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('sample_request_number', __('Sample request number'));
        $show->field('applicant_id', __('Applicant id'));
        $show->field('load_stock_number', __('Load stock number'));
        $show->field('sample_request_date', __('Sample request date'));
        $show->field('proof_of_payment', __('Proof of payment'));
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
        $form = new Form(new SeedSamplingRequest());

        $form->text('sample_request_number', __('Sample request number'));
        $form->text('applicant_id', __('Applicant id'));
        $form->text('load_stock_number', __('Load stock number'));
        $form->date('sample_request_date', __('Sample request date'))->default(date('Y-m-d'));
        $form->text('proof_of_payment', __('Proof of payment'));
        $form->textarea('applicant_remarks', __('Applicant remarks'));

        return $form;
    }
}
