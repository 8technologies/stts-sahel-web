<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\QdsProducer;

class QdsProducerController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'QdsProducer';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new QdsProducer());

        $grid->column('id', __('Id'));
        $grid->column('qds_producer_number', __('Qds producer number'));
        $grid->column('name_of_applicant', __('Name of applicant'));
        $grid->column('applicant_phone_number', __('Applicant phone number'));
        $grid->column('applicant_email', __('Applicant email'));
        $grid->column('applicant_physical_address', __('Applicant physical address'));
        $grid->column('farm_location', __('Farm location'));
        $grid->column('years_of_experience', __('Years of experience'));
        $grid->column('crop_and_variety_experience', __('Crop and variety experience'));
        $grid->column('production_of', __('Production of'));
        $grid->column('has_adequate_land', __('Has adequate land'));
        $grid->column('has_adequate_storage', __('Has adequate storage'));
        $grid->column('has_adequate_equipment', __('Has adequate equipment'));
        $grid->column('has_contractual_agreement', __('Has contractual agreement'));
        $grid->column('has_field_officers', __('Has field officers'));
        $grid->column('has_knowledgeable_personnel', __('Has knowledgeable personnel'));
        $grid->column('land_size', __('Land size'));
        $grid->column('quality_control_mechanisms', __('Quality control mechanisms'));
        $grid->column('receipt', __('Receipt'));
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
        $show = new Show(QdsProducer::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('qds_producer_number', __('Qds producer number'));
        $show->field('name_of_applicant', __('Name of applicant'));
        $show->field('applicant_phone_number', __('Applicant phone number'));
        $show->field('applicant_email', __('Applicant email'));
        $show->field('applicant_physical_address', __('Applicant physical address'));
        $show->field('farm_location', __('Farm location'));
        $show->field('years_of_experience', __('Years of experience'));
        $show->field('crop_and_variety_experience', __('Crop and variety experience'));
        $show->field('production_of', __('Production of'));
        $show->field('has_adequate_land', __('Has adequate land'));
        $show->field('has_adequate_storage', __('Has adequate storage'));
        $show->field('has_adequate_equipment', __('Has adequate equipment'));
        $show->field('has_contractual_agreement', __('Has contractual agreement'));
        $show->field('has_field_officers', __('Has field officers'));
        $show->field('has_knowledgeable_personnel', __('Has knowledgeable personnel'));
        $show->field('land_size', __('Land size'));
        $show->field('quality_control_mechanisms', __('Quality control mechanisms'));
        $show->field('receipt', __('Receipt'));
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
        $form = new Form(new QdsProducer());

        $form->text('qds_producer_number', __('Qds producer number'));
        $form->text('name_of_applicant', __('Name of applicant'));
        $form->text('applicant_phone_number', __('Applicant phone number'));
        $form->text('applicant_email', __('Applicant email'));
        $form->text('applicant_physical_address', __('Applicant physical address'));
        $form->text('farm_location', __('Farm location'));
        $form->number('years_of_experience', __('Years of experience'));
        $form->text('crop_and_variety_experience', __('Crop and variety experience'));
        $form->text('production_of', __('Production of'));
        $form->text('has_adequate_land', __('Has adequate land'));
        $form->text('has_adequate_storage', __('Has adequate storage'));
        $form->text('has_adequate_equipment', __('Has adequate equipment'));
        $form->text('has_contractual_agreement', __('Has contractual agreement'));
        $form->text('has_field_officers', __('Has field officers'));
        $form->text('has_knowledgeable_personnel', __('Has knowledgeable personnel'));
        $form->number('land_size', __('Land size'));
        $form->textarea('quality_control_mechanisms', __('Quality control mechanisms'));
        $form->text('receipt', __('Receipt'));

        return $form;
    }
}
