<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\SeedProducer;
use \App\Models\Crop;
use \App\Models\User;
use \App\Models\Utils;
use \App\Models\Notification;
use OpenAdmin\Admin\Auth\Database\Administrator;
use Illuminate\Support\Facades\Auth;
use OpenAdmin\Admin\Facades\Admin;
use OpenAdmin\Admin\Widgets\Table;

class SeedProducerController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'SeedProducer';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new SeedProducer());

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
        $grid->column('producer_registration_number', __('admin.form.Registration Number'))->display(function ($value) {
            return $value ?? '-';
        });
        
        $grid->column('producer_category', __('admin.form.Seed producer category'))->display(function ($value) {
            return $value ?? '-';
        });
        
        $grid->column('name_of_applicant', __('admin.form.Name of applicant'))->display(function ($value) {
            return $value ?? '-';
        });
        
        $grid->column('status', __('admin.form.Status'))->display(function ($value) {
            return Utils::tell_status($value) ?? '-';
        });
         
        $grid->column('valid_from', __('admin.form.Seed producer approval date'))->display(function ($value) {
            return $value ?? '-';
        });
        
        $grid->column('valid_until', __('admin.form.Valid until'))->display(function ($value) {
            return $value ?? '-';
        });

        $grid->column('id', __('admin.form.Certificate'))->display(function () {
            $link = url('certificate?id=' . $this->id);
            return '<b><a target="_blank" href="' . $link . '">Print Certificate</a></b>';
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
        $show = new Show(SeedProducer::findOrFail($id));
        $user = Auth::user();
        $seed_producer = SeedProducer::findOrFail($id);
        $show->panel()->tools(function ($tools) 
        {
            $tools->disableDelete();
        });
       
        //delete a notification, once it has been read
        if (Admin::user()->isRole('basic-user')) 
        {
            $statusArray = [2, 3, 4, 5];
        
            if (in_array($seed_producer->status, $statusArray))
            {
                Notification::where([
                    'receiver_id' => Admin::user()->id,
                    'model_id' => $id,
                    'model' => 'SeedProducer'
                ])->delete();
            }
        }
        


        $show->field('producer_registration_number', __('admin.form.Seed producer registration number'));
        $show->field('producer_category', __('admin.form.seed producer category'));
        $show->field('name_of_applicant', __('admin.form.Name of applicant'));
        $show->field('applicant_phone_number', __('admin.form.Applicant phone number'));
        $show->field('applicant_email', __('admin.form.Applicant email'));
        $show->field('premises_location', __('admin.form.Applicant physcial address'));
        $show->field('proposed_farm_location', __('admin.form.Proposed farm location'));
        $show->field('years_of_experience', __('admin.form.If seed company, years of experience as a seed producer'));
        $show->field('gardening_history_description', __('admin.form.Garden history of the proposed seed production field for the last three season or years'));
        $show->field('storage_facilities_description', __('admin.form.Describe your storage facilities to handle the resultant seed'));
        $show->field('have_adequate_isolation', __('admin.form.Do you have adequate isolation?'));
        $show->field('labor_details', __('admin.form.Detail the labor you have at the farm in terms of numbers and competencies'));
        $show->field('receipt', __('admin.form.Proof of payment of application fees'));
        $show->field('status', __('admin.form.Status'));
        $show->field('status_comment', __('admin.form.Status comment'));
        $show->field('inspector', __('admin.form.Inspector'));
        $show->field('grower number', __('admin.form.Seed producer approval number'));
        $show->field('valid_from', __('admin.form.Seed producer approval date'));
        $show->field('valid_until', __('admin.form.Valid until'));
        $show->field('crops', __('admin.form.Knowledge of crops and varieties'))->as(function ($crops) {
            return $crops->pluck('crop_name');
        })->label();

        //create a choice form if the user is an admin
       
        if ($user->isRole('administrator')) 
        {
            $show->field('status', __('admin.form.Status'))->as(function ($status) {
                return $status;
            })->editable('select', [1 => 'Pending', 2 => 'Approved', 3 => 'Rejected']);
        }
        

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new SeedProducer());
        $form->tools(function (Form\Tools $tools) 
        {
            $tools->disableDelete();
        });
        $user = Admin::user();

         //check the id of the user before editing the form
         if ($form->isEditing()) 
         {
              //get request id
             $id = request()->route()->parameters()['seed-producer'];
             //get the form
              $seed_producer = SeedProducer::find($id);
 
              //checking the user before accessing the form to ensure the right user accesses the right form
             if ($user->isRole('basic-user'))
             {
             
                 if ($user->id != $seed_producer->user_id) 
                 {
                     $form->html('<div class="alert alert-danger">You cannot edit this form </div>');
                     $form->footer(function ($footer) 
                     {
 
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
             
             //checking if the form has been inspected by the inspector if it is prevent him from editing it again
             if($user->isRole('inspector'))
             {
                  if($seed_producer->status != 2)
                 {
                     $form->html('<div class="alert alert-danger">You cannot edit this form, please commit the commissioner to make any changes. </div>');
                     $form->footer(function ($footer) 
                     {
 
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
 
             
         }

        if ($form->isCreating()) 
        {
            $form->hidden('user_id', __('Administrator id'))->value($user->id);
        } 
        else 
        {
            $form->hidden('user_id', __('Administrator id'));
        }

        $form->saving(function (Form $form) 
        {
            $producer_category = $form->producer_category;
            $seed_producer = SeedProducer::where('producer_category', $producer_category)->where('user_id', $user->id)->first();
            if ($seed_producer) 
            {
                
                    if($form->isEditing())
                    {
                        $form_id = request()->route()->parameters()['seed-producer'];
                        $existing_seed_producer = SeedProducer::find($form_id);
                      //count the number of forms with the same type
                        $count = SeedProducer::where('producer_category', $producer_category)->where('user_id', $user->id)->count();
                        if($count > 1)
                        {
                           
                        }
                        elseif($count == 1)
                        { 
                            return  response(' <p class="alert alert-warning"> You cannot create a new SR4 form  while having PENDING one of the same category. <a href="/admin/form-sr4s"> Go Back </a></p> ');
                            //check if what is being passed to the form is the same as the one in the database
                            if($form_sr4->id == $formSr4->id)
                            {
                                return true;
                            }
                            else
                            {

                                if(!Utils::can_create_form($form_sr4))
                                {
                                    return  response(' <p class="alert alert-warning"> You cannot create a new SR4 form  while having PENDING one of the same category. <a href="/admin/form-sr4s"> Go Back </a></p> ');
                                }
                                
                                //check if its still valid
                                if (Utils::can_renew_app_form($form_sr4)) 
                                {
                                    return  response(' <p class="alert alert-warning"> You cannot create a new SR4 form  while having VALID one of the same category. <a href="/admin/form-sr4s"> Go Back </a></p> ');   
                                }
                            }
                        }
                        else{
                             return true;
                        }

                    }
                    //check if the status of the form is pending, rejected,halted or accepted
                    if(!Utils::can_create_form($form_sr4))
                    {
                        return  response(' <p class="alert alert-warning"> You cannot create a new SR4 form  while having PENDING one of the same category. <a href="/admin/form-sr4s/create"> Go Back </a></p> ');
                    }
                    
                    //check if its still valid
                    if (Utils::can_renew_app_form($form_sr4)) 
                    {
                        return  response(' <p class="alert alert-warning"> You cannot create a new SR4 form  while having VALID one of the same category. <a href="/admin/form-sr4s/create"> Go Back </a></p> ');   
                    }
                $form->accept_declaration = 1;
            }
                     
        });

        //check if the user is a basic user
        if ($user->isRole('basic-user')) 
        {
           
            $form->text('producer_category', __('admin.form.Seed producer category'));
            $form->text('name_of_applicant', __('admin.form.Name of applicant'));
            $form->text('applicant_phone_number', __('admin.form.Applicant phone number'));
            $form->text('applicant_email', __('admin.form.Applicant email'));
            $form->text('premises_location', __('admin.form.Applicant physcial address'));
            $form->text('proposed_farm_location', __('admin.form.Proposed farm location'));
            $form->text('years_of_experience', __('admin.form.If seed company, years of experience as a seed producer'));
            $form->textarea('gardening_history_description', __('admin.form.Garden history of the proposed seed production field for the last three season or years'));
            $form->textarea('storage_facilities_description', __('admin.form.Describe your storage facilities to handle the resultant seed'));
            $form->switch('have_adequate_isolation', __('admin.form.Do you have adequate isolation?'));
            $form->textarea('labor_details', __('admin.form.Detail the labor you have at the farm in terms of numbers and competencies'));
            $form->multipleSelect('crops', __('admin.form.Knowledge of crops and varieties'))->options(Crop::all()->pluck('crop_name', 'id'));
            $form->text('receipt', __('admin.form.Proof of payment of application fees'));
        }

        //check if the user is an administrator
        if ($user->inRoles(['administrator', 'developer']))
        {
            $form->text('name_of_applicant', __('admin.form.Name of applicant'))->default($user->name)->readonly();
            $form->text('premises_location', __('admin.form.Applicant physcial address'))->readonly();
            $form->text('proposed_farm_location', __('admin.form.Proposed farm location'))->readonly();
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
                $form->text('producer_registration_number', __('admin.form.Seed producer registration number'))->default("SeedProducer". "/". mt_rand(10000000, 99999999));
                $form->text('grower number', __('admin.form.Seed producer approval number'))->default("Grower". "/". mt_rand(10000000, 99999999));
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
