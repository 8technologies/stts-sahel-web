<?php

namespace App\Admin\Controllers;

use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Facades\Admin;
use \App\Models\Cooperative;
use \App\Models\Validation;
use \App\Models\Utils;
use Carbon\Carbon;

class CooperativeController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Cooperative Registration';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Cooperative());
        $cooperatives = Cooperative::where('user_id', auth('admin')->user()->id)->get();
        $user = Admin::user();

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
        $grid->column('cooperative_name', __('admin.form.Cooperative name'));
        $grid->column('registration_number', __('admin.form.Registration number'))->display(function ($value) {
            return $value ?? '-';
        })->sortable();
        $grid->column('membership_type', __('admin.form.Membership type'));
        $grid->column('status', __('admin.form.Status'))->display(function ($status) {
            return \App\Models\Utils::tell_status($status)??'-';
        })->sortable();

         //check user role then show a certificate button
         if(!auth('admin')->user()->inRoles(['inspector','commissioner']))
        {
 
             $grid->column('id', __('admin.form.Certificate'))->display(function ($id) use ( $cooperatives) {
                 $cooperative =  $cooperatives->firstWhere('id', $id);
             
                 if ($cooperative && $cooperative->status == 'accepted') {
                     $link = url('cooperative?id=' . $id);
                     return '<b><a target="_blank" href="' . $link . '">Imprimer le certificat</a></b>';
                 } else {
                    
                     return '<b>Aucun certificat disponible</b>';
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
        $show = new Show(Cooperative::findOrFail($id));
        //delete notification after viewing the form
        Utils::delete_notification('Cooperative', $id);

         //check if the user is the owner of the form
         $showable = Validation::checkUser('Cooperative', $id);
         if (!$showable) 
         {
             return('<p class="alert alert-danger">You do not have rights to view this form. <a href="/admin/cooperatives"> Go Back </a></p> ');
         }
       
        $show->field('cooperative_number', __('admin.form.Cooperative number'));
        $show->field('cooperative_name', __('admin.form.Cooperative name'));
        $show->field('registration_number', __('admin.form.Registration number'))->as(function ($value) {
            return $value ?? '-';
        });
        $show->field('cooperative_physical_address', __('admin.form.Cooperative physical address'));
        $show->field('contact_person_name', __('admin.form.Contact person name'));
        $show->field('contact_phone_number', __('admin.form.Contact phone number'));
        $show->field('contact_email', __('admin.form.Contact email'));
        $show->field('membership_type', __('admin.form.Membership type'));
        $show->field('services_to_members', __('admin.form.Services to members'));
        $show->field('objectives_or_goals', __('admin.form.Objectives or goals'));
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

        if ($form->isCreating()) 
        {
            $form->hidden('user_id')->default($user->id);
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
            return redirect('/admin/cooperatives');
        });
       

        if ($user->inRoles(['commissioner', 'inspector', 'developer'])) 
        {
            $form->display('cooperative_number', __('admin.form.Cooperative number'));
            $form->display('cooperative_name', __('admin.form.Cooperative name'));
            $form->display('cooperative_physical_address', __('admin.form.Cooperative physical address'));
            $form->display('contact_person_name', __('admin.form.Name of cooperative president'));
            $form->display('contact_phone_number', __('admin.form.Phone number'));
            $form->display('contact_email', __('admin.form.Email address'));
            $form->display('membership_type', __('admin.form.Membership type'));
            $form->display('services_to_members', __('admin.form.Services to members'));
            $form->display('objectives_or_goals', __('admin.form.Objectives or goals'));
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
                        $form->text('registration_number', __('admin.form.Registration number'))->default('cooperative'.'/'.rand(1000, 100000))->required();
                        $form->datetime('valid_from', __('admin.form.Cooperative approval date'))->default(date('Y-m-d H:i:s'))->required();
                        $nextYear = Carbon::now()->addYear(); // Get the date one year from now
                        $defaultDateTime = $nextYear->format('Y-m-d H:i:s'); // Format the date for default value
                        
                        $form->datetime('valid_until', __('admin.form.Valid until'))
                            ->default($defaultDateTime)
                            ->required();
                    })
                    ->when('inspector assigned', function (Form $form) {

                        //get all inspectors
                        $inspectors = \App\Models\Utils::get_inspectors();
                        $form->select('inspector_id', __('admin.form.Inspector'))
                            ->options($inspectors);
                    })->required();
            }
            //inspector decision
             //inspectors decision
             if ($user->isRole('inspector')) 
             {
              
                 $form->divider('Inspectors decision');
                 $form->radio('status', __('admin.form.Status'))
                     ->options([
                         'recommended'=> __('admin.form.Recommend'),
                         'rejected' => __('admin.form.Rejected'),
                     ])
                     ->when('rejected', function (Form $form) {
                         $form->textarea('status_comment', __('admin.form.Status comment'))->rules('required');
                     })
                     ->when('recommendation', function(Form $form){
                        $form->textarea('inspector_comment', __('Recommendation'));
                     });
 
             }
        } 

        else 
        {
            $form->text('cooperative_number', __('admin.form.Cooperative number'));
            $form->text('cooperative_name', __('admin.form.Cooperative name'))->required();
            $form->text('cooperative_physical_address', __('admin.form.Cooperative physical address'))->required();
            $form->text('contact_person_name', __('admin.form.Name of cooperative president'))->required();
            $form->text('contact_phone_number', __('admin.form.Phone number'))->required();
            $form->text('contact_email', __('admin.form.Email address'))->required();
            $form->text('membership_type', __('admin.form.Membership type'))->required();
            $form->text('services_to_members', __('admin.form.Services to members'))->required();
            $form->text('objectives_or_goals', __('admin.form.Objectives or goals'))->required();
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
