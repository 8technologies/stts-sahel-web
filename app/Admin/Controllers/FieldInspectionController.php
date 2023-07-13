<?php

namespace App\Admin\Controllers;

use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use \App\Models\FieldInspection;

class FieldInspectionController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Field Inspections';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        // $m = FieldInspection::find(3);
        // $m->is_done = 0;
        // $m->field_decision = 'rejected';
        // $m->save();
        // die("romina");
        $grid = new Grid(new FieldInspection());
        $inspection = FieldInspection::where('applicant_id', auth('admin')->user()->id)->value('is_done');
      
        if (!auth('admin')->user()->isRole('commissioner')) {

            if (!auth('admin')->user()->isRole('inspector')) {
                $grid->model()->where('applicant_id', auth('admin')->user()->id);
            } else {
                $grid->model()->where('inspector_id', auth('admin')->user()->id);
            }
        }
        $grid->model()->orderBy('order_number', 'asc');
        $grid->column('created_at', __('Date'))->display(function ($created_at) {
            return date('d-m-Y', strtotime($created_at));
        });

        $grid->actions(function ($actions) {
            $actions->disableDelete();
            if ($actions->row->is_done == 1) {
                $actions->disableEdit();
            }
            if ($actions->row->is_active != 1) {
                $actions->disableEdit();
            }
        });
        $grid->column('applicant_id', __('Applicant'))->display(function ($applicant_id) {
            return \App\Models\User::find($applicant_id)->name;
        });
        $grid->column('field_decision', __('Field decision'));
        $grid->column('is_active', __('Is active'))->using([
            0 => 'Not active',
            1 => 'Active'
        ])->filter([
            0 => 'Not active',
            1 => 'Active'
        ])->dot([
            0 => 'warning',
            1 => 'success'
        ]);
        $grid->column('is_done', __('Is done'));
        $grid->column('inspection_date', __('Inspection date'));

        $grid->column('order_number', __('Order number'));

        if($inspection == 1 ){
            $grid->column('id', __('admin.form.Inspection Report'))->display(function ($id) {
                $link = url('inspection?id=' . $id);
                return '<b><a target="_blank" href="' . $link . '">Print Report</a></b>';
            });
        }
      
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
        $show = new Show(FieldInspection::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('field_inspection_form_number', __('Field inspection form number'));
        $show->field('crop_declaration_id', __('Crop declaration id'));
        $show->field('crop_variety_id', __('Crop variety id'));
        $show->field('inspection_type_id', __('Inspection type id'));
        $show->field('applicant_id', __('Applicant id'));
        $show->field('physical_address', __('Physical address'));
        $show->field('type_of_inspection', __('Type of inspection'));
        $show->field('field_size', __('Field size'));
        $show->field('seed_generation', __('Seed generation'));
        $show->field('crop_condition', __('Crop condition'));
        $show->field('field_spacing', __('Field spacing'));
        $show->field('estimated_yield', __('Estimated yield'));
        $show->field('remarks', __('Remarks'));
        $show->field('inspector_id', __('Inspector id'));
        $show->field('signature', __('Signature'));
        $show->field('field_decision', __('Field decision'));
        $show->field('is_active', __('Is active'));
        $show->field('is_done', __('Is done'));
        $show->field('inspection_date', __('Inspection date'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('order_number', __('Order number'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new FieldInspection());

        $form->display('crop_variety_id', __('Crop variety id'));
        $form->display('inspection_type_id', __('Inspection type id'));
        $form->display('applicant_id', __('Applicant id'));
        $form->display('physical_address', __('Physical address'));
        $form->display('inspector_id', __('Inspector'));

        $form->text('field_inspection_form_number', __('Field inspection form number'));
        $form->decimal('field_size', __('Field size'));
        $form->text('type_of_inspection', __('Type of inspection'));
        $form->text('seed_generation', __('Seed generation'));
        $form->text('crop_condition', __('Crop condition'));
        $form->text('field_spacing', __('Field spacing'));
        $form->decimal('estimated_yield', __('Estimated yield'));
        $form->text('signature', __('Signature'));

        $form->divider();

        $form->select('field_decision', __('Field Decision'))
            ->options([
                'accepted' => 'Approved',
                'rejected' => 'Rejected'
            ])
            ->rules('required');

        $form->textarea('remarks', __('Remarks'));

        return $form;
    }
}
