<?php

namespace App\Admin\Controllers;

use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use \App\Models\FieldInspection;
use \App\Models\Validation;
use \App\Models\Utils;

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
        // $m->status = 'rejected';
        // $m->save();
        // die("romina");
        $grid = new Grid(new FieldInspection());

        //disable create button and delete action
        $grid->disableCreateButton();

        //filter by name
        $grid->filter(function ($filter) {
            // Remove the default id filter
            $filter->disableIdFilter();
            $filter->like('user_id', 'Applicant')->select(\App\Models\User::pluck('name', 'id'));
           
        });
       
        //order the table according to the time
        $grid->model()->orderBy('created_at', 'desc');

        //$inspection = FieldInspection::where('user_id', auth('admin')->user()->id)->value('is_done');
        $inspections = FieldInspection::where('user_id', auth('admin')->user()->id)
        ->get();
        //dd($inspections);

        //show users their respective forms
        if (!auth('admin')->user()->isRole('commissioner')) 
        {

            if (!auth('admin')->user()->isRole('inspector')) {
             
                $grid->model()->where('user_id', auth('admin')->user()->id);
                 //disable delete action
                $grid->actions(function ($actions) {
                    $actions->disableDelete();
                    $actions->disableEdit();
                });
            } else {
                
                $grid->model()->where('inspector_id', auth('admin')->user()->id);
                $grid->actions(function ($actions) {
                    $actions->disableDelete();
                    if ($actions->row->is_done == 1) {
                        $actions->disableEdit();
                    }
                    if ($actions->row->is_active != 1) {
                        $actions->disableEdit();
                    }
                });
            }
        }

        $grid->column('created_at', __('admin.form.Date'))->display(function ($created_at) {
            return date('d-m-Y', strtotime($created_at));
        });

     
        $grid->column('user_id', __('admin.form.Applicant'))->display(function ($user_id) {
            return \App\Models\User::find($user_id)->name;
        });
        $grid->column('status', __('admin.form.Field decision'))->display(function ($status) {
            return \App\Models\Utils::tell_status($status) ?? '-';
        });
        $grid->column('is_active', __('admin.form.Is active'))->using([
            0 => 'Not active',
            1 => 'Active'
        ])->filter([
            0 => 'Not active',
            1 => 'Active'
        ])->dot([
            0 => 'warning',
            1 => 'success'
        ]);

        $grid->column('inspection_date', __('admin.form.Inspection date'));

        $grid->column('order_number', __('admin.form.Order number'));

        //check user role
        if(!auth('admin')->user()->isRole('inspector')){

        $grid->column('id', __('admin.form.Inspection Report'))->display(function ($id) use ($inspections) {
            $inspection = $inspections->firstWhere('id', $id);
        
        if ($inspection && $inspection->is_done == 1) 
        {
                    $link = url('inspection?id=' . $id);
                    return '<b><a target="_blank" href="' . $link . '">Imprimer le rapport</a></b>';
                } else {
                
                    return '<b>Inscription en attente</b>';
                }
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
           //delete notification after viewing the form
           Utils::delete_notification('FieldInspection', $id);

          //check if the user is the owner of the form
          $showable = Validation::checkUser('FieldInspection', $id);
          if (!$showable) 
          {
              return(' <p class="alert alert-danger">You do not have rights to view this form. <a href="/admin/field-inspections"> Go Back </a></p> ');
          }

        $show->field('user_id', __('admin.form.Applicant'))->as(function ($user_id) {
            return \App\Models\User::find($user_id)->name;
        });


        $show->field('crop_variety_id', __('admin.form.Crop Variety'))->as(function ($crop_variety_id) {
            return \App\Models\CropVariety::find($crop_variety_id)->crop_variety_name;
        });
        $show->field('inspection_type_id', __('admin.form.Inspection type'))->as(function ($inspection_type_id) {
            return \App\Models\InspectionType::find($inspection_type_id)->inspection_type_name;
        });

        $show->field('physical_address', __('admin.form.Physical address'))->as(function ($value) {
            return $value ?? '-';
        });
        $show->field('field_size', __('admin.form.Field size'))->as(function ($value) {
            return $value ?? '-';
        });
        $show->field('inspection_date', __('admin.form.Inspection date'))->as(function ($value) {
            return $value ?? '-';
        });
        $show->field('crop_condition', __('admin.form.Crop condition'))->as(function ($value) {
            return $value ?? '-';
        });
        $show->field('field_spacing', __('admin.form.Field spacing'))->as(function ($value) {
            return $value ?? '-';
        });
        $show->field('estimated_yield', __('admin.form.Estimated yield'))->as(function ($value) {
            return $value ?? '-';
        });
        $show->field('remarks', __('admin.form.Remarks'))->as(function ($value) {
            return $value ?? '-';
        });
        $show->field('signature', __('admin.form.Signature'))->as(function ($value) {
            return $value ?? '-';
        });
        $show->field('status', __('admin.form.Status'))->as(function ($status) {
            return Utils::tell_status($status);
        })->unescape();


        $show->field('field_inspection_form_number', __('admin.form.Field inspection form number'))->as(function ($value) {
            return $value ?? '-';
        });;

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
        $user = auth('admin')->user();
           //check if the form is being edited
           if ($form->isEditing()) 
           {
               //get request id
               $id = request()->route()->parameters()['field_inspection'];
               //check if its valid to edit the form
               Validation::checkFormEditable($form, $id, 'FieldInspection');
           }
           //onsaved return to the list page
            $form->saved(function (Form $form) {
            admin_toastr(__('admin.form.Field Inspection saved successfully'), 'success');
            return redirect('/admin/field-inspections');
            });
          

        $form->display('user_id', __('admin.form.Applicant'))->with(function ($user_id) {
            return \App\Models\User::find($user_id)->name;
        });
        $form->display('crop_variety_id', __('admin.form.Crop Variety'))->with(function ($crop_variety_id) {
            return \App\Models\CropVariety::find($crop_variety_id)->crop_variety_name;
        });
        $form->display('inspection_type_id', __('admin.form.Inspection type'))->with(function ($inspection_type_id) {
            return \App\Models\InspectionType::find($inspection_type_id)->inspection_type_name;
        });

        $form->display('physical_address', __('admin.form.Physical address'));
        $form->display('inspector_id', __('admin.form.Inspector'))->with(function ($inspector_id) {
            return \App\Models\User::find($inspector_id)->name;
        });

        $form->text('field_inspection_form_number', __('admin.form.Field inspection form number'))->default('FieldInspection/' . date('Y/') . rand(1000, 9999))->readonly();
        $form->decimal('field_size', __('admin.form.Field size'))->required();
        $form->text('type_of_inspection', __('admin.form.Type of inspection'))->required();
        $form->text('seed_generation', __('admin.form.Seed generation'))->required();
        $form->text('crop_condition', __('admin.form.Crop condition'))->required();
        $form->text('field_spacing', __('admin.form.Field spacing'))->required();
        $form->decimal('estimated_yield', __('admin.form.Estimated yield'))->required();
        $form->text('signature', __('admin.form.Signature'));

        $form->divider();

        $form->select('status', __('admin.form.Field decision'))
            ->options([
                'accepted' => 'Approved',
                'rejected' => 'Rejected'
            ])
            ->rules('required');

        $form->textarea('remarks', __('admin.form.Remarks'));

        //disable delete and view button
        $form->tools(function (Form\Tools $tools) {
            $tools->disableDelete();
            $tools->disableView();
        });

        return $form;
    }
}
