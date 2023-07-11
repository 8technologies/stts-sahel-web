<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use OpenAdmin\Admin\Facades\Admin;
use \App\Models\CropDeclaration;
use \App\Models\CropVariety;
use \App\Models\CustomValidation;
use OpenAdmin\Admin\Auth\Database\Administrator;
use \App\Models\Utils;
use \App\Models\Notification;


class CropDeclarationController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'CropDeclaration';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new CropDeclaration());

           //show the inspector forms where the inspector_id is the same as his id
           $user =Admin::user();
           if ($user->isRole('inspector')) 
           {
               $grid->model()->where('inspector_id', $user->id);
           }
           //disable the create button for users who arent basic users
           if($user->inRoles(['editor', 'developer']))
           {
               $grid->disableCreateButton();
               $grid->actions(function ($actions) 
               {
                   $actions->disableEdit();
               
               });
           }

        $grid->column('id', __('Id'));
        $grid->column('applicant_id', __('Applicant id'));
        $grid->column('applicant_registration_number', __('Applicant registration number'));
        $grid->column('planting_date', __('Planting date'));
        $grid->column('quantity_of_seed_planted', __('Quantity of seed planted'));
        $grid->column('source_lot_number', __('Source lot number'));
        $grid->column('origin_of_variety', __('Origin of variety'));
        $grid->column('status', __('Status'));
        $grid->column('inspector_id', __('Inspector id'));
        $grid->column('lot_number', __('Lot number'));
      

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
        //delete a notification, once it has been read
        if (Admin::user()->isRole('basic-user')) 
        {
            $statusArray = [2, 3, 4, 5];
        
            if (in_array($crop_declaration->status, $statusArray))
            {
                Notification::where([
                    'receiver_id' => Admin::user()->id,
                    'model_id' => $id,
                    'model' => 'CropDeclaration'
                ])->delete();
            }
        }
        $show->panel()->tools(function ($tools) 
        {
            $tools->disableDelete();
        });
        

        $show->field('id', __('Id'));
        $show->field('applicant_id', __('Applicant id'));
        $show->field('phone_number', __('Phone number'));
        $show->field('applicant_registration_number', __('Applicant registration number'));
        $show->field('seed_producer_id', __('Seed producer id'));
        $show->field('garden_size', __('Garden size'));
        $show->field('gps_coordinates_1', __('Gps coordinates 1'));
        $show->field('gps_coordinates_2', __('Gps coordinates 2'));
        $show->field('gps_coordinates_3', __('Gps coordinates 3'));
        $show->field('gps_coordinates_4', __('Gps coordinates 4'));
        $show->field('field_name', __('Field name'));
        $show->field('district_region', __('District region'));
        $show->field('circle', __('Circle'));
        $show->field('township', __('Township'));
        $show->field('village', __('Village'));
        $show->field('planting_date', __('Planting date'));
        $show->field('quantity_of_seed_planted', __('Quantity of seed planted'));
        $show->field('expected_yield', __('Expected yield'));
        $show->field('seed_supplier_name', __('Seed supplier name'));
        $show->field('seed_supplier_registration_number', __('Seed supplier registration number'));
        $show->field('source_lot_number', __('Source lot number'));
        $show->field('origin_of_variety', __('Origin of variety'));
        $show->field('garden_location_latitude', __('Garden location latitude'));
        $show->field('garden_location_longitude', __('Garden location longitude'));
        $show->field('status', __('Status'));
        $show->field('inspector_id', __('Inspector id'));
        $show->field('lot_number', __('Lot number'));
        $show->field('remarks', __('Remarks'));
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
        $form = new Form(new CropDeclaration());
        $user = Admin::user();

        //before loading the form check if the user is a valid seed producer
        if($form->isCreating())
        {
           $seed_producer = CustomValidation::validateFormStatus('SeedProducer');
           if(!$seed_producer){
            return admin_warning('Seed Producer Certificate', 'You are not a valid seed producer, please register as a seed producer first');
           }
        }
        
        if ($user->isRole('basic-user')) 
        {
            $form->text('applicant_id', __('Applicant name'))->default($user->name)->readonly();    
            $form->hidden('applicant_id')->value($user->id);        
            $form->text('phone_number', __('Phone number'));
            $form->text('applicant_registration_number', __('Applicant registration number'));
            $form->number('seed_producer_id', __('Seed producer id'));
            $form->decimal('garden_size', __('Garden size'));
            $form->decimal('gps_coordinates_1', __('Gps coordinates 1'));
            $form->decimal('gps_coordinates_2', __('Gps coordinates 2'));
            $form->decimal('gps_coordinates_3', __('Gps coordinates 3'));
            $form->decimal('gps_coordinates_4', __('Gps coordinates 4'));
            $form->text('field_name', __('Field name'));
            $form->text('district_region', __('District region'));
            $form->text('circle', __('Circle'));
            $form->text('township', __('Township'));
            $form->text('village', __('Village'));
            $form->date('planting_date', __('Planting date'))->default(date('Y-m-d'));
            $form->number('quantity_of_seed_planted', __('Quantity of seed planted'));
            $form->number('expected_yield', __('Expected yield'));
            $form->text('seed_supplier_name', __('Seed supplier name'));
            $form->text('seed_supplier_registration_number', __('Seed supplier registration number'));
            $form->text('source_lot_number', __('Source lot number'));
            $form->text('origin_of_variety', __('Origin of variety'));
            $form->decimal('garden_location_latitude', __('Garden location latitude'));
            $form->decimal('garden_location_longitude', __('Garden location longitude'));
            $form->multipleSelect('crop_varieties', __('admin.form.Select crop varieties'))->options(CropVariety::all()->pluck('crop_variety_name', 'id'));
        }
           //check if the user is an administrator
           if ($user->inRoles(['administrator', 'developer']))
           {
               $form->text('applicant_id', __('admin.form.Name of applicant'))->default($user->name)->readonly();
               $form->text('field_name', __('Field name'))->readonly();
               $form->date('planting_date', __('Planting date'))->default(date('Y-m-d'));
               //get the users in the admin_user table whose role is inspector
               $inspectors = Administrator::whereHas('roles', function ($query) {
                   $query->where('slug', 'inspector');
               })->get();
               $form->select('inspector_id', __('admin.form. Assign inspector'))->options($inspectors->pluck('name', 'id'));
               $form->hidden('status', __('admin.form.Status'))->value(2);
           }
   
           //check if the user is an inspector
           if ($user->isRole('inspector')) 
           {
              
               $form->radio('status', __('admin.form.Status'))
               ->options
               ([
                   3 => 'Accepted',
                   4 => 'Please Resubmit',
                   5 => 'Rejected'
               ])->required()
               ->when(3, function(Form $form)
               {
                   $form->text('lot_number', __('Lot number'))->default("SeedProducer". "/". mt_rand(10000000, 99999999));
                  
               })
   
               ->when('in', [4, 5], function (Form $form) 
               {
                   $form->textarea('remarks', __('Remarks'))
                   ->help( __('admin.form.Please specify your reason'));
               });
      
              }

        return $form;
    }
}
