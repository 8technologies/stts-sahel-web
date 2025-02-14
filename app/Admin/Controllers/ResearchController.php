<?php

namespace App\Admin\Controllers;

use App\Models\Research;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Facades\Admin;
use Illuminate\Support\Carbon;
use \App\Models\Validation;
use \App\Models\Utils;

class ResearchController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected function title()
    {
        return trans('admin.form.Research');
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Research());

        $user = Admin::user();
         
        //hide details from other farmer roles
        if(!$user->inRoles(['research','developer','inspector','commissioner','basic-user']))
        {
            return Validation::allowVerifiedUserToView($grid);
        }

        //function to show the loggedin user only what belongs to them
         Validation::showUserForms($grid);

        //order of table
        $grid->model()->orderBy('id', 'desc');

        //disable action buttons appropriately
        Utils::disable_buttons('Research', $grid);

        //disable batch actions only without disabling the export button
        $grid->disableBatchActions();
        //Utils::disable_batch_actions($grid);

        //disable create button 
        if ($user->inRoles(['research'])) 
        {
            $grid->disableCreateButton();
        }

       //filter by name
       $grid->filter(function ($filter) 
       {
        // Remove the default id filter
        $filter->disableIdFilter();

        if (Admin::user()->inRoles(['research','basic-user'])) 
        {
            //filte by seed generation
            $filter->equal('seed_generation', __('admin.form.Seed generation'))->select(
                [
                    'Prébase' => 'Prébase',
                    'Base' => 'Base',
                ]
            );
        }
        else{
            //filter by user
            $filter->like('user_id', 'Applicant')->select(\App\Models\User::pluck('name', 'id'));
        }
      
       });

        $grid->column('created_at', __('admin.form.Date'))->display(function ($created_at) {
            return date('d-m-Y', strtotime($created_at));
        });
        $grid->column('user_id', __('admin.form.Applicant'))->display(function ($user_id) {
            return \App\Models\User::find($user_id)->name??'-';
        });
        $grid->column('researcher_registration_number', __('admin.form.Research registration number'))->display(function ($value) {
            return $value ?? '-';
        })->sortable();
        //$grid->column('seed_generation', __('admin.form.Seed generation'))->sortable();
        $grid->column('seed_generation', __('admin.form.Seed generation'))
        ->display(function ($seed_generation) {
            return \App\Models\SeedClass::whereIn('id', $seed_generation)
            ->pluck('class_name')
            ->implode(', '); // Convert array to a comma-separated string
        });
        $grid->column('status', __('admin.form.Status'))->display(function ($status) {
            return \App\Models\Utils::tell_status($status)??'-';
        })->sortable();
        $grid->column('valid_from', __('admin.form.Seed producer approval date'))->display(function ($value) {
            return $value ?? '-';
        });
        $grid->column('valid_until', __('admin.form.Valid until'))->display(function ($value) {
            return $value ?? '-';
        });

        //check user role then show a certificate button

        $grid->column('id', __('admin.form.Certificate'))->display(function ($id) {
            $seed_producer =  Research::find($id);
        
            if ($seed_producer&& $seed_producer->status == 'accepted') {
                $link = url('research_report?id=' . $id);
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
        $show = new Show(Research::findOrFail($id));
        //delete notification after viewing the form
        Utils::delete_notification('Research', $id);

        //check if the user is the owner of the form
        $showable = Validation::checkUser('Research', $id);
        if (!$showable) 
        {
            return(' <p class="alert alert-danger">You do not have rights to view this form. <a href="/seed-producers"> Go Back </a></p> ');
        }

        $show->field('user_id', __('admin.form.Applicant Name'))->as(function ($user_id) {
            return \App\Models\User::find($user_id)->name;
        });
        $show->field('researcher_registration_number', __('admin.form.Research registration number'))->as(function ($value) {
            return $value ?? '-';
        });

        $show->field('seed_generation', __('admin.form.Seed generation'))->as(function ($seedGeneration) {
            // Assuming $seedGeneration contains an array of seed class IDs
            
            return \App\Models\SeedClass::whereIn('id', $seedGeneration)
                ->pluck('class_name')
                ->implode(', '); // Display the names as a comma-separated string
        });

        $show->field('applicant_phone_number', __('admin.form.Applicant phone number'));
        $show->field('applicant_email', __('admin.form.Applicant email'));
        $show->field('premises_location', __('admin.form.Applicant physical address'));
        $show->field('proposed_farm_location', __('admin.form.Proposed farm location'));
        $show->field('years_of_experience', __('admin.form.years of experience'));
        $show->field('storage_facilities_description', __('admin.form.Describe your storage facilities to handle the resultant seed'));
        $show->field('receipt', __('admin.form.Proof of payment of application fees'))->as(function ($receipt) {
            return $receipt == null ? 'No file uploaded' : '<a href="/storage/' . $receipt . '" target="_blank">View receipt</a>';
        })->unescape();
        $show->field('status', __('admin.form.Status'))->as(function ($status) {
            return \App\Models\Utils::tell_status($status) ?? '-';
        })->unescape();
        $show->field('status_comment', __('admin.form.Status comment'))->as(function ($value) {
            return $value ?? '-';
        });
        $show->field('valid_from', __('admin.form.Seed producer approval date'))->as(function ($value) {
            return $value ?? '-';
        });
        $show->field('valid_until', __('admin.form.Valid until'))->as(function ($value) {
            return $value ?? '-';
        });

        //disable delete and edit button
        $show->panel()->tools(function ($tools) 
        {
            $tools->disableDelete();
            $tools->disableEdit();
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
        $form = new Form(new Research());

        $user = auth()->user();

        //When form is creating, assign user id
        if ($form->isCreating()) 
        {
            $form->hidden('user_id')->default($user->id);
            //check if the user is allowed to create the form
            if(!$user->isRole('basic-user'))
            {
              return Validation:: allowBasicUserToCreate($form);
            }
        }

        //check if the form is being edited
        if ($form->isEditing()) 
        {
            //get request id
            $id = request()->route()->parameters()['research'];
            //check if its valid to edit the form
            Validation::checkFormEditable($form, $id, 'Research');
        }
       
        //onsaved return to the list page
         $form->saved(function (Form $form) 
        {
            admin_toastr(__('admin.form.Form submitted successfully'), 'success');
            return redirect('/research');
        });
       
      
        //admin, inspector and developer
        if ($user->inRoles(['commissioner','developer', 'inspector'])) 
        {

            $seedClasses = \App\Models\Utils::getSeedClassNamesByRoleSlug('research');
            
            $form->display('seed_generation', __('admin.form.Seed generation'))
            ->with(function ($seed_generation) {
                return \App\Models\SeedClass::whereIn('id', $seed_generation)
                ->pluck('class_name')
                ->implode(', ');  // Convert array to a comma-separated string
            });
            
            $form->display('applicant_phone_number', __('admin.form.Applicant phone number'));
            $form->display('applicant_email', __('admin.form.Applicant email'));
            $form->display('premises_location', __('admin.form.Applicant physical address'));
            $form->display('proposed_farm_location', __('admin.form.Proposed farm location'));
            $form->display('years_of_experience', __('admin.form.years of experience'));
            $form->display('storage_facilities_description', __('admin.form.Describe your storage facilities to handle the resultant seed'));
            $form->display('recommendation', __('admin.form.Recommendation'));

            $form->file('receipt', __('admin.form.Proof of payment of application fees'))->readonly();

            //admin decision
            if ($user->inRoles(['commissioner','administrator','developer'])) 
            {
                $form->divider('Administartor decision');
                $form->radioButton('status', __('admin.form.Status'))
                ->options([
                    'accepted'=> __('admin.form.Accepted'),
                    'halted' => __('admin.form.Halted'),
                    'rejected' => __('admin.form.Rejected'),
                    'inspector assigned' => __('admin.form.Assign Inspector'),
                ])
                    ->when('in', ['rejected', 'halted'], function (Form $form) {
                        $form->textarea('status_comment', __('admin.form.Status comment'))->rules('required');
                    })
                    ->when('accepted', function (Form $form) {
                        $form->text('researcher_registration_number', __('admin.form.Research registration number')) ->default('DCCS/RESEARCH/' . rand(1000, 100000).'/'. date('Y') )->required();
                        $form->datetime('valid_from', __('admin.form.Research approval date'))->default(date('Y-m-d H:i:s'))->required();
                        $nextYear = Carbon::now()->addYear(); // Get the date one year from now
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

            //inspectors decision
            if ($user->isRole('inspector')) 
            {
             
                $form->divider('Inspectors decision');
                $form->radioButton('status', __('admin.form.Status'))
                    ->options([
                        'recommended'=> __('admin.form.Recommend'),
                       
                    ])->required()
                    ->when('recommended', function(Form $form)
                    {
                       $form->textarea('recommendation', __('Recommendation'))->rules('required');
                    });

            }
        }

        //basic user
        else 
        {

            $seedClasses = \App\Models\Utils::getSeedClassNamesByRoleSlug('research');
            $form->multipleSelect('seed_generation', __('admin.form.Seed generation'))
            ->options($seedClasses )
            ->required();
            
            $form->text('applicant_phone_number', __('admin.form.Applicant phone number'))->required();
            $form->text('applicant_email', __('admin.form.Applicant email'))->required();
            $form->text('premises_location', __('admin.form.Applicant physical address'))->required();
            $form->text('proposed_farm_location', __('admin.form.Proposed farm location'))->required();
            $form->text('years_of_experience', __('admin.form.years of experience'));
            $form->textarea('storage_facilities_description', __('admin.form.Describe your storage facilities to handle the resultant seed'))->required();
            $form->file('receipt', __('admin.form.Proof of payment of application fees'))
            ->rules(['mimes:jpeg,pdf,jpg', 'max:1048']) // Assuming a maximum file size of 1MB 
            ->help(__('admin.form.Attach a copy of your proof of payment, and should be in pdf, jpg or jpeg format'));
            $form->hidden('status')->default('pending');
            $form->hidden('inspector_id')->default(null);
        }

        //disable delete and view button
        $form->tools(function (Form\Tools $tools) 
        {
            $tools->disableDelete();
            $tools->disableView();
        });

        //disable bottom buttons/checkboxes
        $form->disableViewCheck();
        $form->disableEditingCheck();
        $form->disableCreatingCheck();

        return $form;
    }
}
