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

        //disable create button and delete action
        $grid->disableCreateButton();
         //disable delete action
         $grid->actions(function ($actions) {
            $actions->disableDelete();
        });

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
        $grid->column('field_decision', __('Field decision'))->display(function ($field_decision) {
            return $field_decision ?? '-';
       });
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

        $show->field('applicant_id', __('Applicant '))->as(function ($applicant_id) {
            return \App\Models\User::find($applicant_id)->name;
        });
       
       
        $show->field('crop_variety_id', __('Crop variety '))->as(function ($crop_variety_id) {
            return \App\Models\CropVariety::find($crop_variety_id)->crop_variety_name;
        });
        $show->field('inspection_type_id', __('Inspection type'))->as(function ($inspection_type_id) {
            return \App\Models\InspectionType::find($inspection_type_id)->inspection_type_name;
        });
       
        $show->field('physical_address', __('Physical address'));
        $show->field('field_size', __('Field size'));
        $show->field('inspection_date', __('Inspection date'));
        $show->field('crop_condition', __('Crop condition'));
        $show->field('field_spacing', __('Field spacing'));
        $show->field('estimated_yield', __('Estimated yield'));
        $show->field('remarks', __('Remarks'));
        $show->field('signature', __('Signature'));
        $show->field('field_decision', __('Field decision'));
    
       
        $show->field('field_inspection_form_number', __('Field inspection form number'));

        //disable edit button
        $show->panel()->tools(function ($tools) {
            $tools->disableEdit();
            $tools->disableDelete();
        });

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
        
        $form->display('applicant_id', __('Applicant id'))->with(function ($applicant_id) {
            return \App\Models\User::find($applicant_id)->name;
        });
        $form->display('crop_variety_id', __('Crop variety id'))->with(function ($crop_variety_id) {
            return \App\Models\CropVariety::find($crop_variety_id)->crop_variety_name;
        });
        $form->display('inspection_type_id', __('Inspection type id'))->with(function ($inspection_type_id) {
            return \App\Models\InspectionType::find($inspection_type_id)->inspection_type_name;
        });
       
        $form->display('physical_address', __('Physical address'));
        $form->display('inspector_id', __('Inspector'))->with(function ($inspector_id) {
            return \App\Models\User::find($inspector_id)->name;
        });

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

        //disable delete and view button
        $form->tools(function (Form\Tools $tools) {
            $tools->disableDelete();
            $tools->disableView();
        });

        return $form;
    }
}
