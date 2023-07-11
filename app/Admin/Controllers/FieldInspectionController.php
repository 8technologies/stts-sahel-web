<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\FieldInspection;
use \App\Models\CustomValidation;
use OpenAdmin\Admin\Facades\Admin;
use OpenAdmin\Admin\Auth\Database\Administrator;

class FieldInspectionController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'FieldInspection';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new FieldInspection());
        $user = Admin::user();
        if($user->inRoles(['basic-user','administrator']))
        {
            $grid->disableCreateButton();
            $grid->actions(function ($actions) 
            {
                $actions->disableEdit();
            
            });
        }

        $grid->column('id', __('Id'));
        $grid->column('applicant_id', __('Applicant id'))->display (function ($applicant_id) 
        {
            return Administrator::find($applicant_id)->name;
        });

        
        $grid->column('field_inspection_form_number', __('Field inspection form number'));
        $grid->column('crop_variety', __('Crop variety'))->display (function ($crop_variety) 
        {
            return $crop_variety['crop_variety_name'];
        });
        $grid->column('inspection_type', __('Inspection type'))->display (function ($inspection_type_id) 
        {
            return $inspection_type_id['inspection_type_name'];
        });
    
        $grid->column('inspector_id', __('Inspector '))->display (function ($inspection_type_id) 
        {
            return Administrator::find($inspection_type_id)->name;
        });
        $grid->column('is_active', __('Status'))->display (function ($is_active) 
        {
            if($is_active == 1 )
            {
                return "<span class='badge bg-warning'>Active</span>";
            }
            else
            {
                return "<span class='badge bg-danger'>Inactive</span>";
            }
        });
        $grid->column('field_decision', __('Field decision'));
        $grid->column('inspection_date', __('Inspection date'));
      

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
        $show->panel()->tools(function ($tools) 
        {
            $tools->disableDelete();
        });
       

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
        $show->field('inspection_date', __('Inspection date'));
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
        $form = new Form(new FieldInspection());
        $user = Admin::user();
        $form->tools(function (Form\Tools $tools) 
        {
            $tools->disableDelete();
        });

        if($form->isEditing())
        {
            //get id of the model being edited
              $model_id = request()->route()->parameters()['field_inspection'];
            //get the field inspection status
           $field_inspection= CustomValidation::validateFieldInspectionStatus('FieldInspection', $model_id);
           if($field_inspection == false){
             admin_error('This inspection has either already been submitted and cannot be edited,or it has not been approved');
             $form->footer(function ($footer) {

                // disable reset btn
                $footer->disableReset();
            
                // disable submit btn
                $footer->disableSubmit();
            
                // disable `View` checkbox
                $footer->disableViewCheck();
            
                // disable `Continue editing` checkbox
                $footer->disableEditingCheck();
            
                // disable `Continue Creating` checkbox
                $footer->disableCreatingCheck();
            
            });
           }
        }

         //check if the user is an inspector
         if ($user->inRole(['inspector','developer'])) 
         {
            $form->text('field_inspection_form_number', __('Field inspection form number'));
            $form->text('crop_declaration_id', __('Crop declaration id'));
            $form->number('crop_variety_id', __('Crop variety id'));
            $form->number('inspection_type_id', __('Inspection type id'));
            $form->text('applicant_id', __('Applicant id'));
            $form->text('physical_address', __('Physical address'));
            $form->text('type_of_inspection', __('Type of inspection'));
            $form->decimal('field_size', __('Field size'));
            $form->text('seed_generation', __('Seed generation'));
            $form->text('crop_condition', __('Crop condition'));
            $form->text('field_spacing', __('Field spacing'));
            $form->decimal('estimated_yield', __('Estimated yield'));
            $form->textarea('remarks', __('Remarks'));
            $form->text('signature', __('Signature'));
            $form->radio('field_decision', __('Field decision'))->options(['1' => 'Approved', '0'=> 'Rejected'])->default('1');
            $form->date('inspection_date', __('Inspection date'))->default(date('Y-m-d'));    
         }

        return $form;
    }
}
