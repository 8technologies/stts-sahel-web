<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\LoadStock;
use OpenAdmin\Admin\Auth\Database\Administrator;
use OpenAdmin\Admin\Facades\Admin;
use \App\Models\CustomValidation;

class LoadStockController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'LoadStock';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new LoadStock());
           //show the inspector forms where the inspector_id is the same as his id
           $user =Admin::user();
           if ($user->isRole('inspector')) 
           {
               $grid->model()->where('inspector_id', $user->id);
           }
           //disable the create button for users who arent basic users
           if($user->inRoles(['administrator', 'developer']))
           {
               $grid->disableCreateButton();
           }

        $grid->column('id', __('Id'));
        $grid->column('load_stock_number', __('Crop stock number'));
        $grid->column('planting_return_number', __('Crop declartaion number'));
        $grid->column('applicant_id', __('Name of applicant'))->display(function($applicant_id){
            return Administrator::find($applicant_id)->name;
        });
        $grid->column('registration_number', __('Registration number'));
        $grid->column('yield_quantity', __('Yield quantity'));
        $grid->column('last_field_inspection_date', __('Last field inspection date'));
        $grid->column('load_stock_date', __('Crop stock date'));


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
        $show = new Show(LoadStock::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('load_stock_number', __('Crop stock number'));
        $show->field('planting_return_number', __('Crop declaration number'));
        $show->field('applicant_id', __('Name of applicant'));
        $show->field('registration_number', __('Registration number'));
        $show->field('seed_class', __('Seed class'));
        $show->field('field_size', __('Field size'));
        $show->field('yield_quantity', __('Yield quantity'));
        $show->field('last_field_inspection_date', __('Last field inspection date'));
        $show->field('load_stock_date', __('Crop stock date'));
        $show->field('last_field_inspection_remarks', __('Last field inspection remarks'));
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
        $form = new Form(new LoadStock());
        $user = \Admin::user();
      
         //before loading the form check if the user is a valid seed producer
         if($form->isCreating())
         {
            $crop_declaration = CustomValidation::validateCropDeclaration();
            if(!$crop_declaration){
             return admin_warning('Crop Declaration', 'You have not made a crop declaration . Please make a crop declaration first or wait for it to be accepted  before you can load stock.');
            }
            $form->hidden('applicant_id', __('Administrator id'))->value($user->id);
         }else 
         {
             $form->hidden('applicant_id', __('Administrator id'));
         }

       
        $form->text('planting_return_number', __('Crop declaration number'));
        $form->text('name_of_applicant', __('Name of applicant'));
        $form->text('registration_number', __('Registration number'));
        $form->text('seed_class', __('Seed class'));
        $form->decimal('field_size', __('Field size'));
        $form->decimal('yield_quantity', __('Yield quantity'));
        $form->date('last_field_inspection_date', __('Last field inspection date'))->default(date('Y-m-d'));
        $form->date('load_stock_date', __('Crop stock date'))->default(date('Y-m-d'));
        $form->textarea('last_field_inspection_remarks', __('Last field inspection remarks'));

         //check if the user is an administrator
         if ($user->inRoles(['administrator', 'developer']))
         {
             $form->text('name_of_applicant', __('admin.form.Name of applicant'))->default($user->name)->readonly();
             $form->text('planting_return_number', __('Crop declaration number'))->readonly();
             $form->text('seed_class', __('Seed class'))->readonly();
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
                $form->text('name_of_applicant', __('admin.form.Name of applicant'))->default($user->name)->readonly();
                $form->text('planting_return_number', __('Crop declaration number'))->readonly();
                $form->text('seed_class', __('Seed class'))->readonly();
                 $form->text('load_stock_number', __('Crop stock number'))->default("Grower". "/". mt_rand(10000000, 99999999));
                 $form->datetime('valid_from', __('admin.form.Seed producer approval date'))->default(date('Y-m-d H:i:s'));
                 $form->datetime('valid_until', __('admin.form.Valid until'))->default(date('Y-m-d H:i:s'));
             })
 
             ->when('in', [4, 5], function (Form $form) 
             {
                 $form->textarea('status_comment', __('admin.form.Status comment'))
                 ->help( __('admin.form.Please specify your reason'));
             });       
             
         }

        return $form;
    }
}
