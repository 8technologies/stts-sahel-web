<?php

namespace App\Admin\Controllers;

use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Facades\Admin;
use \App\Models\Cooperative;
use App\Models\SeedClass;
use \App\Models\Validation;
use \App\Models\Utils;
use Carbon\Carbon;
use Encore\Admin\Auth\Database\Role;

class CooperativeController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
   
  
    protected function title()
    {
        return trans('admin.form.Cooperative Registration');
    }


    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Cooperative());
        $user = Admin::user();

        // disable batch delete
         $grid->disableBatchActions();
        //hide details from other farmer roles
        if(!$user->inRoles(['cooperative','developer','inspector','commissioner','basic-user']))
        {
            return Validation::allowVerifiedUserToView($grid);
        }



        //function to show the loggedin user only what belongs to them
        Validation::showUserForms($grid);

        //order in descending order
        $grid->model()->orderBy('id', 'desc');

        //filter by cooperative name
        $grid->filter(function ($filter) 
        {
            // Remove the default id filter
            $filter->disableIdFilter();
            $filter->like('cooperative_name', __('admin.form.Cooperative name'));
        });

        //disable create button 
        if ($user->inRoles(['cooperative'])) 
        {
            $grid->disableCreateButton();
        }
      
        //disable action buttons appropriately
        Utils::disable_buttons('cooperative', $grid);
      
        $grid->column('cooperative_number', __('admin.form.Cooperative number'));
        $grid->column('date_of_creation', __('admin.form.Date of creation'))->display(function ($date) {
            return date('d-m-Y', strtotime($date));
        })->sortable();
        $grid->column('cooperative_name', __('admin.form.Cooperative name'));
        $grid->column('registration_number', __('admin.form.Registration number'))->display(function ($value) {
            return $value ?? '-';
        })->sortable();
      
        $grid->column('status', __('admin.form.Status'))->display(function ($status) {
            return \App\Models\Utils::tell_status($status)??'-';
        })->sortable();

      
             $grid->column('id', __('admin.form.Certificate'))->display(function ($id) {
                 $cooperative =  Cooperative::find($id);
             
                 if ($cooperative && $cooperative->status == 'accepted') {
                     $link = url('cooperative?id=' . $id);
                     return '<b><a target="_blank" href="' . $link . '">Imprimer le certificat</a></b>';
                 } else {
                    
                     return '<b>Aucun certificat disponible</b>';
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
        $show = new Show(Cooperative::findOrFail($id));
        //delete notification after viewing the form
        Utils::delete_notification('Cooperative', $id);

         //check if the user is the owner of the form
         $showable = Validation::checkUser('Cooperative', $id);
         if (!$showable) 
         {
             return('<p class="alert alert-danger">You do not have rights to view this form. <a href="/cooperatives"> Go Back </a></p> ');
         }
       
         $show->field('seed_generation', __('admin.form.Seed generation'))->as(function ($seedGeneration) {
            // Assuming $seedGeneration contains an array of seed class IDs
            
            return \App\Models\SeedClass::whereIn('id', $seedGeneration)
                ->pluck('class_name')
                ->implode(', '); // Display the names as a comma-separated string
        });
        $show->field('cooperative_number', __('admin.form.Cooperative number'));
        $show->field('date_of_creation', __('admin.form.Date of creation'));
        $show->field('cooperative_name', __('admin.form.Cooperative name'));
        $show->field('registration_number', __('admin.form.Registration number'))->as(function ($value) {
            return $value ?? '-';
        });
        $show->field('cooperative_physical_address', __('admin.form.Cooperative physical address'));
        $show->field('contact_person_name', __('admin.form.Contact person name'));
        $show->field('contact_phone_number', __('admin.form.Contact phone number'));
        $show->field('contact_email', __('admin.form.Contact email'));
        $show->field('proof_of_payment', __('admin.form.Proof of payment'));
        $show->field('status', __('admin.form.Status'))->as(function ($status) {
            return \App\Models\Utils::tell_status($status) ?? '-';
        })->unescape();
        $show->field('status_comment', __('admin.form.Status comment'))->as(function ($value) {
            return $value ?? '-';
        });
      
        $show->field('valid_from', __('admin.form.Cooperative approval date'))->as(function ($value) {
            return $value ?? '-';
        });
        $show->field('valid_until', __('admin.form.Valid until'))->as(function ($value) {
            return $value ?? '-';
        });
       

        //disable edit and delete button
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
        $form = new Form(new Cooperative());

        $user = auth()->user();
    
        //When form is creating, assign user id
        if ($form->isCreating()) 
        {
            $form->hidden('user_id')->default($user->id);
            //check if the user is allowed to create the form
            if(!$user->isRole('basic-user')){
            return Validation:: allowBasicUserToCreate($form);
            }
        }
        
        //check if the form is being edited
        if ($form->isEditing()) 
        {
            //get request id
            $id = request()->route()->parameters()['cooperative'];
             Validation::checkFormEditable($form, $id, 'Cooperative');
        }

         //onsaved return to the list page
        $form->saved(function (Form $form) 
        {
            admin_toastr(__('admin.form.Form submitted successfully'), 'success');
            return redirect('/cooperatives');
        });
       

        if ($user->inRoles(['commissioner', 'inspector', 'developer'])) 
        {
            $form->display('seed_generation', __('admin.form.Seed generation'))
            ->with(function ($seed_generation) {
                return \App\Models\SeedClass::whereIn('id', $seed_generation)
                ->pluck('class_name')
                ->implode(', ');  // Convert array to a comma-separated string
            });
            $form->display('cooperative_number', __('admin.form.Cooperative number'));
            $form->display('date_of_creation', __('admin.form.Date of creation'));
            $form->display('cooperative_name', __('admin.form.Cooperative name'));
            $form->display('cooperative_physical_address', __('admin.form.Cooperative physical address'));
            $form->display('contact_person_name', __('admin.form.Name of cooperative president'));
            $form->display('contact_phone_number', __('admin.form.Phone number'));
            $form->display('contact_email', __('admin.form.Email address'));
            $form->display('proof_of_payment', __('admin.form.Proof of payment'))->readonly();
            $form->display('recommendation', __('admin.form.Recommendation'));
            //admin decision
            if ($user->inRoles(['commissioner','developer'])) 
            {
                $form->divider('Administartor decision');
                $form->radioButton('status', __('admin.form.Status'))
                    ->options([
                        'accepted' => __('admin.form.Accepted'),
                        'rejected' => __('admin.form.Rejected'),
                        'halted' => __('admin.form.Halted'),
                        'inspector assigned' => __('admin.form.Assign Inspector'),

                    ])
                    ->when('in', ['rejected', 'halted'], function (Form $form) {
                        $form->textarea('status_comment', __('admin.form.Status comment'))->rules('required');;
                    })
                    ->when('accepted', function (Form $form) {
                        //get the current year
                        $year = date('y');

                        $form->text('registration_number', __('admin.form.Registration number'))->default('DCCS/COOP/'.rand(1000, 10000).'/'. date('Y') )->required();
                        $form->datetime('valid_from', __('admin.form.Cooperative approval date'))->default(date('Y-m-d H:i:s'))->required();
                        $nextYear = Carbon::now()->addYears(3); // Get the date one year from now
                        $defaultDateTime = $nextYear->format('Y-m-d H:i:s'); // Format the date for default value
                        
                        $form->datetime('valid_until', __('admin.form.Valid until'))
                            ->default($defaultDateTime)
                            ->required();
                    })
                    ->when('inspector assigned', function (Form $form) {

                        //get all inspectors
                        $inspectors = \App\Models\Utils::get_inspectors();

                        // Convert to an array
                        $inspectorsArray = $inspectors->toArray();

                        // Get the first inspector's ID as the default value
                         $firstInspectorId = array_key_first($inspectorsArray);

                        $form->select('inspector_id', __('admin.form.Inspector'))
                            ->options($inspectors)
                            ->default($firstInspectorId);
                            
                    })->required();
            }
            //inspector decision
             //inspectors decision
             if ($user->isRole('inspector')) 
             {
              
                 $form->divider('Inspectors decision');
                 $form->radioButton('status', __('admin.form.Status'))
                     ->options([
                         'recommended'=> __('admin.form.Recommend'),
                      
                     ])
                     ->when('recommended', function(Form $form){
                        $form->textarea('recommendation', __('admin.form.Recommendation'))->rules('required');
                     })->required();
 
             }
        } 

        else 
        {
            $seedClasses = \App\Models\Utils::getSeedClassNamesByRoleSlug('Cooperative');
            $form->multipleSelect('seed_generation', __('admin.form.Seed generation'))
            ->options($seedClasses )
            ->required();

            $form->text('cooperative_number', __('admin.form.Cooperative number'))->required();
            $form->date('date_of_creation', __('admin.form.Date of creation'))->required();
            $form->text('cooperative_name', __('admin.form.Cooperative name'))->required();
            $form->text('cooperative_physical_address', __('admin.form.Cooperative physical address'))->required();
            $form->text('contact_person_name', __('admin.form.Name of cooperative president'))->required();
            $form->text('national_id', __('admin.form.ID'));
            $form->text('contact_phone_number', __('admin.form.Phone number'))->required();
            $form->text('contact_email', __('admin.form.Email address'))->required();
            $form->file('proof_of_payment', __('admin.form.Proof of payment'))
            ->rules(['mimes:jpeg,pdf,jpg', 'max:1048']) // Assuming a maximum file size of 1MB 
            ->help(__('admin.form.Attach a copy of your proof of payment, and should be in pdf, jpg or jpeg format'));
            $form->hidden('status')->default('pending');
            $form->hidden('inspector_id')->default(null);
        }

         //disable the edit and delete action buttons
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
