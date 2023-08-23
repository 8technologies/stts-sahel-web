<?php

namespace App\Admin\Controllers;

use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Facades\Admin;
use \App\Models\Cooperative;
use \App\Models\Validation;

class CooperativeController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Cooperative';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Cooperative());
        $user = Admin::user();
        //order in descending order
        $grid->model()->orderBy('id', 'desc');

        //filter by cooperative name
        $grid->filter(function ($filter) {
            // Remove the default id filter
            $filter->disableIdFilter();
            $filter->like('cooperative_name', __('admin.form.Cooperative name'));
        });

        if (!$user->isRole('basic-user')) {
            //disable create button and delete
            $grid->disableCreateButton();
            $grid->actions(function ($actions) {
                $actions->disableDelete();
            });
        }
        if ($user->isRole('cooperative')) {
            $grid->actions(function ($actions) {
                $actions->disableEdit();
                $actions->disableDelete();
            });
        }
        // show inspector what has been assigned to him
        if (auth('admin')->user()->isRole('inspector')) {
            $grid->model()->where('inspector_id', auth('admin')->user()->id);
        }

        //show the user only his records
        if (auth('admin')->user()->isRole('basic-user')) {
            $grid->model()->where('user_id', auth('admin')->user()->id);
        }

        //show the cooperative only his records
        if (auth('admin')->user()->isRole('cooperative')) {
            $grid->model()->where('user_id', auth('admin')->user()->id);
        }


        $grid->column('id', __('Id'));
        $grid->column('cooperative_number', __('admin.form.Cooperative number'));
        $grid->column('cooperative_name', __('admin.form.Cooperative name'));
        $grid->column('registration_number', __('admin.form.Registration number'))->display(function ($value) {
            return $value ?? '-';
        })->sortable();
        $grid->column('membership_type', __('admin.form.Membership type'));
        $grid->column('status', __('admin.form.Status'))->display(function ($status) {
            return \App\Models\Utils::tell_status($status);
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
        $show = new Show(Cooperative::findOrFail($id));

        $show->field('id', __('Id'));
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

        if ($form->isCreating()) {
            $form->hidden('user_id')->default($user->id);
        }

        //check if the form is being edited
        if ($form->isEditing()) 
        {
                //get request id
               $id = request()->route()->parameters()['cooperative'];
              
               if($user->inRoles(['basic-user', 'cooperative'])){
                //check if the user is the owner of the form
                   $editable = Validation::checkUser('Cooperative', $id);
                   if(!$editable){
                      $form->html(' <p class="alert alert-warning">You do not have rights to edit this form. <a href="/admin/cooperatives"> Go Back </a></p> ');
                      $form->footer(function ($footer) 
                      {
  
                          // disable reset btn
                          $footer->disableReset();
  
                          // disable submit btn
                          $footer->disableSubmit();
                     });
                   }
                   //check if the form has been accepted
                   $editable_status = Validation::checkFormUserStatus('Cooperative', $id);
                     if(!$editable_status){
                      $form->html(' <p class="alert alert-warning">You cannot edit this form because it has been accepted. <a href="/admin/cooperatives"> Go Back </a></p> ');
                      $form->footer(function ($footer) 
                      {
      
                            // disable reset btn
                            $footer->disableReset();
      
                            // disable submit btn
                            $footer->disableSubmit();
                     });
                     }
               }
               elseif($user->isRole('inspector')){
                   $editable = Validation::checkFormStatus('Cooperative', $id);
                   
                   if(!$editable){

                  
                       $form->html(' <p class="alert alert-warning">You do not have rights to edit this form. <a href="/admin/cooperatives"> Go Back </a></p> ');
                       $form->footer(function ($footer) 
                    {

                        // disable reset btn
                        $footer->disableReset();

                        // disable submit btn
                        $footer->disableSubmit();
                   });
               }
               
           }
        }

        if ($user->inRoles(['commissioner', 'inspector', 'developer'])) 
        {
            $form->display('cooperative_number', __('admin.form.Cooperative number'));
            $form->display('cooperative_name', __('admin.form.Cooperative name'));
            $form->display('cooperative_physical_address', __('admin.form.Cooperative physical address'));
            $form->display('contact_person_name', __('admin.form.Contact person name'));
            $form->display('contact_phone_number', __('admin.form.Contact phone number'));
            $form->display('contact_email', __('admin.form.Contact email'));
            $form->display('membership_type', __('admin.form.Membership type'));
            $form->display('services_to_members', __('admin.form.Services to members'));
            $form->display('objectives_or_goals', __('admin.form.Objectives or goals'));
            //admin decision
            if ($user->inRoles(['commissioner','developer'])) {
                $form->divider('Administartor decision');
                $form->radioButton('status', __('admin.form.Status'))
                    ->options([
                        'accepted' => __('admin.form.Accepted'),
                        'rejected' => __('admin.form.Rejected'),
                        'halted' => __('admin.form.Halted'),
                        'inspector assigned' => __('admin.form.Assign Inspector'),

                    ])
                    ->when('in', ['rejected', 'halted'], function (Form $form) {
                        $form->textarea('status_comment', __('admin.form.Status comment'));
                    })
                    ->when('accepted', function (Form $form) {
                        $form->text('registration_number', __('admin.form.Registration number'))->default('cooperative'.'/'.rand(1000, 100000))->required();
                    })
                    ->when('inspector assigned', function (Form $form) {

                        //get all inspectors
                        $inspectors = \App\Models\Utils::get_inspectors();
                        $form->select('inspector_id', __('admin.form.Inspector'))
                            ->options($inspectors);
                    })->required();
            }
            //inspector decision
            if ($user->isRole('inspector')) {
                $form->divider('Inspector decision');
                $form->radioButton('status', __('admin.form.Status'))
                    ->options([
                        'accepted' => 'Accepted',
                        'rejected' => 'Rejected',
                        'halted' => 'Halted',

                    ])
                    ->when('in', ['rejected', 'halted'], function (Form $form) {
                        $form->textarea('status_comment', __('admin.form.Status comment'));
                    })
                    ->when('accepted', function (Form $form) {
                        $form->text('registration_number', __('Registration number'))->default(rand(1000, 100000))->required();
                    })->required();
            }
        } 
        else 
        {
            $form->text('cooperative_number', __('Cooperative number'));
            $form->text('cooperative_name', __('Cooperative name'));
            $form->text('cooperative_physical_address', __('Cooperative physical address'));
            $form->text('contact_person_name', __('Contact person name'));
            $form->text('contact_phone_number', __('Contact phone number'));
            $form->text('contact_email', __('Contact email'));
            $form->text('membership_type', __('Membership type'));
            $form->text('services_to_members', __('Services to members'));
            $form->text('objectives_or_goals', __('Objectives or goals'));
        }
        //disable delete button
        $form->tools(function (Form\Tools $tools) {
            $tools->disableView();
            $tools->disableDelete();
        });

        return $form;
    }
}
