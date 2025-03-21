<?php

namespace App\Admin\Controllers;

use App\Models\CropDeclaration;
use App\Models\CropVariety;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use \App\Models\FieldInspection;
use \App\Models\Validation;
use \App\Models\Utils;
use Illuminate\Support\Facades\Log;

class FieldInspectionController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */

    protected function title()
    {
        return trans('admin.form.Field Inspections');
    }


    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new FieldInspection());

        //disable create button and delete action
        $grid->disableCreateButton();

        //filter by name
        $grid->filter(function ($filter) 
        {
            // Remove the default id filter
            $filter->disableIdFilter();
            $filter->like('user_id', 'Applicant')->select(\App\Models\User::pluck('name', 'id'));
           
        });
       
        //disable batch and export actions
        Utils::disable_batch_actions($grid);

        //order the table according to the time
        $grid->model()->orderBy('created_at', 'desc');

        //$inspection = FieldInspection::where('user_id', auth('admin')->user()->id)->value('is_done');

        //show users their respective forms
        if (!auth('admin')->user()->inRoles(['commissioner','administrator','developer'])) 
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
                    if ($actions->row->is_done == 1 || $actions->row->is_active != 1) {
                        $actions->disableEdit();
                    }
                });
            }
        }

        else
        {
            //disable delete and edit action
           $grid->actions(function ($actions) 
           {
               $actions->disableDelete();
               $actions->disableEdit();
           });
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
            0 => __('admin.form.Inactive'),
            1 => __('admin.form.Active')
        ])->filter([
            0 => __('admin.form.Inactive'),
            1 => __('admin.form.Active')
        ])->dot([
            0 => 'warning',
            1 => 'success'
        ]);

        $grid->column('inspection_date', __('admin.form.Inspection date'));
        $grid->column('order_number', __('admin.form.Order number'));
        $grid->column('id', __('admin.form.Inspection Report'))->display(function ($id)
        {
            $inspection = FieldInspection::find($id);
        
            if ($inspection && $inspection->is_done == 1) 
            {
                $link = url('inspection?id=' . $id);
                return '<b><a target="_blank" href="' . $link . '">Imprimer le rapport</a></b>';
            } else
            {          
                return '<b>Inscription en attente</b>';
            }
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
        $show = new Show(FieldInspection::findOrFail($id));
        //delete notification after viewing the form
        Utils::delete_notification('FieldInspection', $id);

        //check if the user is the owner of the form
        $showable = Validation::checkUser('FieldInspection', $id);
        if (!$showable) 
        {
            return(' <p class="alert alert-danger">You do not have rights to view this form. <a href="/field-inspections"> Go Back </a></p> ');
        }

        $show->field('user_id', __('admin.form.Applicant'))->as(function ($user_id) {
            return \App\Models\User::find($user_id)->name;
        });
        $field_inspection = request()->route()->parameters()['field_inspection'];
            
        $coop_seed_name = FieldInspection::where('id', $field_inspection)->pluck('coop_seed_name')->first(); 
                // check if the cooperative/seed company name is empty
        if (!empty($coop_seed_name)) {
            $show->field('coop_seed_name', __('admin.form.Cooperative/seed company name'));
        }
        
        $show->field('crop_variety_id', __('admin.form.Crop Variety'))->as(function ($crop_variety_id) {
            $cropVariety = \App\Models\CropVariety::with('crop')->find($crop_variety_id);
        
            if ($cropVariety && $cropVariety->crop) {
                return $cropVariety->crop->crop_name . ' - (' . $cropVariety->crop_variety_name.')';
            }
        
            return 'N/A'; // Fallback in case of missing data
        });

        $show->field('inspection_type_id', __('admin.form.Inspection type'))->as(function ($inspection_type_id) {
            return \App\Models\InspectionType::find($inspection_type_id)->inspection_type_name;
        });
        $show->field('previous_seed_culture', __('admin.form.Field history'))
         ->required();

        $show->field('planting_date', __('admin.form.Planting date'));
        $show->field('origin_of_variety', __('admin.form.Origin of variety'));
        
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
        $show->field('health_status', __('admin.form.Form Health status'));
            
        $show->field('off_types', __('admin.form.Off types'))->as(function ($value) {
            return $value == '0' ? __('admin.form.Yes') : __('admin.form.No');
        });

        $inspection = FieldInspection::findOrFail($id);
        // Conditionally show additional fields if off_types is '0' (Yes)
        if ($inspection->off_types == '0') {
            $show->field('level', __('admin.form.Level'))->as(function ($value) {
                return $value;
            });

            $show->field('number_of_offtypes', __('admin.form.Number of off types'))->as(function ($value) {
                return $value;
            });
        }

        $show->field('field_spacing', __('admin.form.Field spacing'))->as(function ($value) {
            return $value ?? '-';
        });
        $show->field('estimated_yield', __('admin.form.Estimated yield(kgs)'))->as(function ($value) {
            return $value ?? '-';
        });

        $show->field('plant_density', __('admin.form.Plant density'))->as(function ($value) {
            return $value ?? '-';
        });

        $show->field('planting_ratio', __('admin.form.Planting ratio'))->as(function ($value) {
            return $value ?? '-';
        });

        $show->field('isolation', __('admin.form.isolation'))->as(function ($value) {
            return $value ?? '-';
        });

        $show->field('isolation_time', __('admin.form.isolation_time'))->as(function ($value) {
            return $value ?? '-';
        });

        $show->field('isolation_distance', __('admin.form.isolation_distance'))->as(function ($value) {
            return $value ?? '-';
        });

        
        $show->field('remarks', __('admin.form.Remarks'))->as(function ($value) {
            return $value ?? '-';
        });
        $show->field('signature', __('admin.form.Signature'))->as(function ($signature) {
            return $signature == null ? 'No file uploaded' : '<a href="/storage/' . $signature . '" target="_blank">View receipt</a>';
        })->unescape();
        $show->field('status', __('admin.form.Status'))->as(function ($status) {
            return Utils::tell_status($status);
        })->unescape();
        $show->field('field_inspection_form_number', __('admin.form.Field inspection form number'))->as(function ($value) {
            return $value ?? '-';
        });

        //disable edit button
        $show->panel()->tools(function ($tools) 
        {
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

            //check if the user is not the assigned inspector or commissioner and disable the form
            if (!$user->inRoles(['inspector', 'commissioner'])) 
            {
                $form->html('<p class="alert alert-danger">' . __('admin.form.no_rights_to_edit_form') . '</p>');

                $form->footer(function ($footer) 
                {

                    // disable reset btn
                    $footer->disableReset();

                    // disable submit btn
                    $footer->disableSubmit();
                });
                
            }
        }
        
        //onsaved return to the list page
        $form->saved(function (Form $form) 
        {
            // Log::info('$form');
            admin_toastr(__('admin.form.Field Inspection saved successfully'), 'success');
            return redirect('/field-inspections');
        });
          
        $form->display('user_id', __('admin.form.Applicant'))->with(function ($user_id) {
            return \App\Models\User::find($user_id)->name;
        });
        $form->display('id', __('admin.form.Crop Declaration Form'))
        ->with(function($id) {
            // $id = $form->model()->id ?? null; // Ensure the ID exists
            $field_inspection = FieldInspection::findOrFail($id);
            $CropDeclaration = $field_inspection->crop_declaration;
            Log::info($CropDeclaration->id);
            if ($id) {
                return '<a href="'.admin_url('crop-declarations/'.$CropDeclaration->id).'" target="_blank">'.__('admin.form.Go to Crop Declaration Form').'</a>';
            }
            return 'No Crop Declaration Form available';
        });

        $form->display('coop_seed_name', __('admin.form.Cooperative/seed company name'));
        $form->select('seed_generation', __('admin.form.Seed generation'))->options(
            \App\Models\SeedClass::all()->pluck('class_name', 'id')->all() 
        )->readOnly();
        
        // $form->display('crop_variety_id', __('admin.form.Crop Variety'))->with(function ($crop_variety_id) {
        //     return \App\Models\CropVariety::find($crop_variety_id)->crop_variety_name;
        // });
        $form->display('crop_variety_id', __('admin.form.Crop Variety'))->with(function ($crop_variety_id) {
            $cropVariety = \App\Models\CropVariety::with('crop')->find($crop_variety_id);
        
            if ($cropVariety && $cropVariety->crop) {
                return $cropVariety->crop->crop_name . ' - ' . $cropVariety->crop_variety_name;
            }
        
            return 'N/A'; // Fallback in case of missing data
        });

        $form->display('previous_seed_culture', __('admin.form.Field history'))
         ->required();

        $form->display('inspection_type_id', __('admin.form.Inspection type'))->with(function ($inspection_type_id) {
            return \App\Models\InspectionType::find($inspection_type_id)->inspection_type_name;
        });

        $form->display('physical_address', __('admin.form.Physical address'));
        $form->display('inspector_id', __('admin.form.Inspector'))->with(function ($inspector_id) {
            return \App\Models\User::find($inspector_id)->name;
        });

        $form->text('field_inspection_form_number', __('admin.form.Field inspection form number'))->default('FieldInspection/' . date('Y/') . rand(1000, 9999))->readonly();
        $form->decimal('field_size', __('admin.form.Field size'))->required();

        
        $form->display('planting_date', __('admin.form.Planting date'));
        $form->display('origin_of_variety', __('admin.form.Origin of variety'));
        
        $form->text('crop_condition', __('admin.form.Crop condition'))->required();
        $form->text('health_status', __('admin.form.Form Health status'))->required();
        
        $form->radio('off_types', __('admin.form.Off types'))
        ->options([
            '0' => __('admin.form.Yes'),
            '1' => __('admin.form.No')
        ])
        ->when('0', function (Form $form) {
            $form->select('level', __('admin.form.Level'))->options(
                [
                    'high' => __('admin.form.High'),
                    'medium' => __('admin.form.Medium'),
                    'low' => __('admin.form.Low'),
                ]
            )->rules('required');
            $form->number('number_of_offtypes', __('admin.form.Number of off types'))->rules('required');
        })->required();
        
        $form->select('plant_density', __('admin.form.Plant density'))->options([
            'low' =>__('admin.form.Low'),
            'optimal' => __('admin.form.Optimal'),
            'high' => __('admin.form.High')
        ])->required();
        $form->radio('seed_category', __('admin.form.Seed Category'))->options([
           'opv' => 'OPV',
            'hybrid' => 'Hybrid'

        ])
        ->when('hybrid', function (Form $form) {
            $form->select('planting_ratio', __('admin.form.Planting ratio'))->options(
                [
                    '2:1' => '2:1',
                    '3:1' => '3:1',
                ]
            )->rules('required');
        })->required();
        

        $form->radio('isolation', __('admin.form.isolation'))->options([
            'temps' => 'Temps',
             'distance' => 'Distance'
        ])->when('distance', function (Form $form) {
            $form->decimal('isolation_distance', __('admin.form.isolation_distance'))->rules('required');
        })
        ->when('temps', function (Form $form) {
            $form->select('isolation_time', __('admin.form.isolation_time'))->options(
                [
                    'Adéquat' => 'Adéquat',
                    'Inadéquat' => 'Inadéquat',

                ]
            )->rules('required');
        })->required();
       
        $form->decimal('estimated_yield', __('admin.form.Estimated yield(kgs)'))->required();
        $form->file('signature', __('admin.form.Signature'))->required();

        $form->divider();

        $form->select('status', __('admin.form.Field decision'))
            ->options([
                'accepted' => __('admin.form.Approved'),
                'rejected' => __('admin.form.Rejected'),
            ])
            ->rules('required');

        $form->textarea('remarks', __('admin.form.Recommendation'));

        //disable delete and view button
        $form->tools(function (Form\Tools $tools) {
            $tools->disableDelete();
            $tools->disableView();
        });

        //disbale check boxes
        $form->disableCreatingCheck()
            ->disableEditingCheck()
            ->disableViewCheck();
        return $form;
    }
}
