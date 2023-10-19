<?php

namespace App\Admin\Controllers;

use App\Models\Crop;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use \App\Models\CropDeclaration;
use App\Models\CropVariety;
use App\Models\SeedProducer;
use App\Models\Utils;
use Encore\Admin\Auth\Database\Administrator;
use Encore\Admin\Facades\Admin;
use \App\Models\Validation;

class CropDeclarationController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Crop Declaration Forms';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new CropDeclaration());
        $crop_declaration = CropDeclaration::where('user_id', auth('admin')->user()->id)->value('status');
        $user = auth()->user();
           
        //function to show the loggedin user only what belongs to them
        Validation::showUserForms($grid);

        //order of table
        $grid->model()->orderBy('id', 'desc');

        //disable action buttons appropriately
        Utils::disable_buttons('CropDeclaration', $grid);

        //filter by name
        $grid->filter(function ($filter) 
        {
        // Remove the default id filter
        $filter->disableIdFilter();
        $filter->like('user_id', 'Applicant')->select(\App\Models\User::pluck('name', 'id'));
        
        });
    
        $grid->column('user_id', __('admin.form.Applicant'))->display(function ($user_id) {
            return \App\Models\User::find($user_id)->name;
        });
        
        $grid->column('crop_variety_id', __('admin.form.Crop Variety'))->display(function ($crop_variety_id) {
            return CropVariety::find($crop_variety_id)->crop_variety_name;
        });
        $grid->column('garden_size', __('admin.form.Garden size'));
        $grid->column('field_name', __('admin.form.Field name'));
        $grid->column('planting_date', __('admin.form.Planting date'))->display(function ($planting_date) {
            return date('d-m-Y', strtotime($planting_date));
        });
        $grid->column('status', __('admin.form.Status'))
            ->display(function ($status) {
                return Utils::tell_status($status);
            })->sortable();


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
        $show = new Show(CropDeclaration::findOrFail($id));
        $crop_declaration = CropDeclaration::findOrFail($id);
        $user = auth()->user();

         //delete notification after viewing the form
         Utils::delete_notification('CropDeclaration', $id);

         //check if the user is the owner of the form
         $showable = Validation::checkUser('CropDeclaration', $id);
         if (!$showable) 
         {
             return(' <p class="alert alert-danger">You do not have rights to view this form. <a href="/admin/seed-producers"> Go Back </a></p> ');
         }
 
        $show->field('user_id', __('admin.form.Applicant Name'))->as(function ($user_id) {
            return \App\Models\User::find($user_id)->name;
        });
        //crop varietie
        $show->field('crop_variety_id', __('admin.form.Crop Variety'))->as(function ($crop_variety_id) {
            return CropVariety::find($crop_variety_id)->crop_variety_name;
        });
        $show->field('phone_number', __('admin.form.Phone number'));
        $show->field('garden_size', __('admin.form.Garden size'));
        $show->field('gps_coordinates_1', __('admin.form.GPS coordinates 1'));
        $show->field('gps_coordinates_2', __('admin.form.GPS coordinates 2'));
        $show->field('gps_coordinates_3', __('admin.form.GPS coordinates 3'));
        $show->field('gps_coordinates_4', __('admin.form.GPS coordinates 4'));
        $show->field('field_name', __('admin.form.Field name'));
        $show->field('district_region', __('admin.form.District/Region'));
        $show->field('circle', __('admin.form.Circle'));
        $show->field('township', __('admin.form.Township'));
        $show->field('village', __('admin.form.Village'));
        $show->field('planting_date', __('admin.form.Planting date'));
        $show->field('quantity_of_seed_planted', __('admin.form.Quantity of seed planted'));
        $show->field('expected_yield', __('admin.form.Expected yield'));
        $show->field('seed_supplier_name', __('admin.form.Seed supplier name'));
        $show->field('seed_supplier_registration_number', __('admin.form.Seed supplier registration number'));
        $show->field('source_lot_number', __('admin.form.Source lot number'));
        $show->field('origin_of_variety', __('admin.form.Origin of variety'));
        $show->field('garden_location_latitude', __('admin.form.Garden location latitude'));
        $show->field('garden_location_longitude', __('admin.form.Garden location longitude'));
        $show->field('status', __('admin.form.Status'))->as(function ($status) {
            return Utils::tell_status($status);
        })->unescape();
        $show->field('remarks', __('admin.form.Remarks'))->as(function ($remarks) {
            return $remarks == null ? 'No remarks yet' : $remarks;
        });

        //if the user is a commissioner, show the inspector
        if ($user->isRole('commissioner')) 
        {
            //check if inspector_id is not null
            if ($crop_declaration->inspector_id == null) {
                $show->field('inspector_id', __('admin.form.Inspector'))->as(function ($inspector_id) {
                    return 'No inspector assigned yet';
                });
            } else {
                $show->field('inspector_id', __('admin.form.Inspector'))->as(function ($inspector_id) {
                    return \App\Models\User::find($inspector_id)->name;
                });
            }
        }

        //disable delete and edit button
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
        // $m = CropDeclaration::find(9);
        // $m->remarks .= 'test';
        // $m->save();
        // die("romina");
        $form = new Form(new CropDeclaration());

        $user = auth()->user();
        if ($form->isCreating()) 
        {
            $form->hidden('user_id')->default($user->id);
        }

        //check if the form is being edited
        if ($form->isEditing()) 
        {
            //get request id
            $id = request()->route()->parameters()['crop_declaration'];
            //check if its valid to edit the form
            Validation::checkFormEditable($form, $id, 'CropDeclaration');
        }

        if ($user->inRoles(['basic-user', 'grower','agro-dealer'])) 
        {
            $form->select('crop_variety_id', __('admin.form.Crop Variety'))
                ->options(CropVariety::all()->pluck('crop_variety_name', 'id'))
                ->required();

            $form->text('phone_number', __('admin.form.Phone number'))->required();
            $form->decimal('garden_size', __('admin.form.Garden size'))->required();
            $form->decimal('gps_coordinates_1', __('admin.form.GPS coordinates 1'))
                ->rules('required|numeric|between:-9999.999999,9999.999999', [
                    'numeric' => 'Coordinates must be a numeric value.',
                    'between' => 'Coordinates must be between -9999.999999 and 9999.999999.',
                ])
                ->required();
            $form->decimal('gps_coordinates_2', __('admin.form.GPS coordinates 2'))->rules('required|numeric|between:-9999.999999,9999.999999', [
                'numeric' => 'Coordinates must be a numeric value.',
                'between' => 'Coordinates must be between -9999.999999 and 9999.999999.',
            ])
            ->required();
            $form->decimal('gps_coordinates_3', __('admin.form.GPS coordinates 3'))->rules('required|numeric|between:-9999.999999,9999.999999', [
                'numeric' => 'Coordinates must be a numeric value.',
                'between' => 'Coordinates must be between -9999.999999 and 9999.999999.',
            ])
            ->required();
            $form->decimal('gps_coordinates_4', __('admin.form.GPS coordinates 4'))->rules('required|numeric|between:-9999.999999,9999.999999', [
                'numeric' => 'Coordinates must be a numeric value.',
                'between' => 'Coordinates must be between -9999.999999 and 9999.999999.',
            ])
            ->required();
            $form->text('field_name', __('admin.form.Field name'))->required();
            $form->text('district_region', __('admin.form.District/Region'))->required();
            $form->text('circle', __('admin.form.Circle'))->required();
            $form->text('township', __('admin.form.Township'))->required();
            $form->text('village', __('admin.form.Village'))->required();
            $form->date('planting_date', __('admin.form.Planting date'))->default(date('Y-m-d'))->required();
            $form->number('quantity_of_seed_planted', __('admin.form.Quantity of seed planted(kgs)'))->required();
            $form->number('expected_yield', __('admin.form.Expected yield(kgs)'))->required();
            $form->text('seed_supplier_name', __('admin.form.Seed supplier name'))->required();
            $form->text('seed_supplier_registration_number', __('admin.form.Seed supplier registration number'))->required();
            $form->text('source_lot_number', __('admin.form.Source lot number'))->required();
            $form->text('origin_of_variety', __('admin.form.Origin of variety'))->required();
            $form->decimal('garden_location_latitude', __('admin.form.Garden location latitude'))->rules('required|numeric|between:-9999.999999,9999.999999', [
                'numeric' => 'Coordinates must be a numeric value.',
                'between' => 'Coordinates must be between -9999.999999 and 9999.999999.',
            ]);
            $form->decimal('garden_location_longitude', __('admin.form.Garden location longitude'))->rules('required|numeric|between:-9999.999999,9999.999999', [
                'numeric' => 'Coordinates must be a numeric value.',
                'between' => 'Coordinates must be between -9999.999999 and 9999.999999.',
            ]);
            $form->textarea('details', __('admin.form.Provide more details about the garden'));
            $form->hidden('status')->default('pending');
            $form->hidden('inspector_id')->default(null);

        }

        if ($user->inRoles(['commissioner','developer'])) 
        {
            $form->display('crop_variety_id', __('admin.form.Crop variety'))
                ->with(function ($crop_variety_id) {
                    return CropVariety::find($crop_variety_id)->crop_variety_name;
                })
                ->required();

            $form->display('phone_number', __('admin.form.Phone number'));
            $form->display('garden_size', __('admin.form.Garden size'));
            $form->display('gps_coordinates_1', __('admin.form.Gps coordinates 1'));
            $form->display('gps_coordinates_2', __('admin.form.Gps coordinates 2'));
            $form->display('gps_coordinates_3', __('admin.form.Gps coordinates 3'));
            $form->display('gps_coordinates_4', __('admin.form.Gps coordinates 4'));
            $form->display('field_name', __('admin.form.Field name'));
            $form->display('district_region', __('admin.form.District/Region'));
            $form->display('circle', __('admin.form.Circle'));
            $form->display('township', __('admin.form.Township'));
            $form->display('village', __('admin.form.Village'));
            $form->display('planting_date', __('admin.form.Planting date'))->default(date('Y-m-d'));
            $form->display('quantity_of_seed_planted', __('admin.form.Quantity of seed planted(kgs)'));
            $form->display('expected_yield', __('admin.form.Expected yield(kgs)'));
            $form->display('seed_supplier_name', __('admin.form.Seed supplier name'));
            $form->display('seed_supplier_registration_number', __('admin.form.Seed supplier registration number'));
            $form->display('source_lot_number', __('admin.form.Source lot number'));
            $form->display('origin_of_variety', __('admin.form.Origin of variety'));
            $form->display('garden_location_latitude', __('admin.form.Garden location latitude'))->rules('required|numeric|digits:10|between:-9999.999999,9999.999999', [
                'numeric' => 'Coordinates must be a numeric value.',
                'digits'  => 'Coordinates must have exactly 10 digits in total.',
                'between' => 'Coordinates must be between -9999.999999 and 9999.999999.',
            ])
            ->required();
            $form->display('garden_location_longitude', __('admin.form.Garden location longitude'))->rules('required|numeric|digits:10|between:-9999.999999,9999.999999', [
                'numeric' => 'Coordinates must be a numeric value.',
                'digits'  => 'Coordinates must have exactly 10 digits in total.',
                'between' => 'Coordinates must be between -9999.999999 and 9999.999999.',
            ])
            ->required();
            $form->display('details', __('admin.form.Provide more details about the garden'));

            $form->divider(__('admin.form.Administrator decision'));
            $form->radioButton('status', __('admin.form.Status'))
            ->options([
                'rejected' => 'Rejected',
                'halted' => 'Halted',
                'inspector assigned' => 'Assign Inspector',

            ])
            ->when('in', ['rejected', 'halted'], function (Form $form) {
                $form->textarea('status_comment', __('admin.form.Status comment'));
            })
            ->when('inspector assigned', function (Form $form) {

                //get all inspectors
                $inspectors = \App\Models\Utils::get_inspectors();
                $form->select('inspector_id', __('admin.form.Inspector'))
                    ->options($inspectors);
            })->required();

            
        }

        //disable delete and view button
        $form->tools(function (Form\Tools $tools) 
        {
            $tools->disableDelete();
            $tools->disableView();
        });

        //disable checkboxes
        $form->disableViewCheck();
        $form->disableEditingCheck();
        $form->disableCreatingCheck();

        return $form;
    }
}
