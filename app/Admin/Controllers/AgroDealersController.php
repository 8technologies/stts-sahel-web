<?php

namespace App\Admin\Controllers;

use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Facades\Admin;
use App\Models\Utils;
use App\Models\Validation;

use \App\Models\AgroDealers;

class AgroDealersController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Agro Dealers';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new AgroDealers());
        //order of table
        $grid->model()->orderBy('id', 'desc');

        $agro_dealer = AgroDealers::where('applicant_id', auth('admin')->user()->id)->value('status');
    
        $user = Admin::user();

        //filter by first name
        $grid->filter(function ($filter) 
        {
            // Remove the default id filter
            $filter->disableIdFilter();
            $filter->like('first_name', __('admin.form.First name'));
        });

       // show inspector what has been assigned to him
       if (auth('admin')->user()->isRole('inspector')) 
        {
            $grid->model()->where('inspector_id', auth('admin')->user()->id);
        }
       
       
        if (!$user->inRoles(['basic-user'])) 
        {
            //disable create button and delete
            $grid->disableCreateButton();
        
            $grid->actions(function ($actions) 
            {
                $actions->disableDelete();
            });
        }
       
        if ($user->isRole('basic-user'))
        {
             //show the user only his records
                $grid->model()->where('applicant_id', auth('admin')->user()->id);
                if ($agro_dealer != null) {
                    if ($agro_dealer == 'inspector assigned') {
                        //disable create button 
                        $grid->disableCreateButton();
                        $grid->actions(function ($actions) {
                            $actions->disableDelete();
                            $actions->disableEdit();
                        });
                    }elseif($agro_dealer == 'halted' || $agro_dealer == 'pending'){
                        //disable create button 
                        $grid->disableCreateButton();
                        $grid->actions(function ($actions) {
                            $actions->disableDelete();
                            
                        });
                    }elseif($agro_dealer == 'rejected'){
                    
                        $grid->actions(function ($actions) {
                            $actions->disableDelete();
                            $actions->disableEdit();
                        });
                }
            }else{
                //disable create button 
                $grid->disableCreateButton();
                $grid->actions(function ($actions) {
                    $actions->disableDelete();
                    
                });
            }
        }
       

        if ($user->isRole('agro-dealer'))
        {
            $grid->model()->where('applicant_id', auth('admin')->user()->id);
            $grid->disableCreateButton();
            $grid->actions(function ($actions) {
                $actions->disableEdit();
                $actions->disableDelete();
            });
        }

        $grid->column('agro_dealer_reg_number', __('admin.form.Agro-dealer registration number'))->display(function ($value) {
            return $value ?? '-';
        })->sortable();
        $grid->column('first_name', __('admin.form.First name'));
        $grid->column('last_name', __('admin.form.Last name'));
        $grid->column('email', __('admin.form.Email'));
        $grid->column('physical_address', __('admin.form.Physical address'));
        $grid->column('status', __('admin.form.Status'))->display(function ($status) {
            return \App\Models\Utils::tell_status($status);
        })->sortable();

        //show the print certificate button if the status is accepted
        if ($agro_dealer == 'accepted') 
        {

            $grid->column('id', __('admin.form.Certificate'))->display(function ($id) {
                $link = url('agro_certificate?id=' . $id);
                return '<b><a target="_blank" href="' . $link . '">Print Certificate</a></b>';
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
        $show = new Show(AgroDealers::findOrFail($id));

        $show->field('agro_dealer_reg_number', __('admin.form.Agro-dealer registration number'));
        $show->field('first_name', __('admin.form.First name'));
        $show->field('last_name', __('admin.form.Last name'));
        $show->field('email', __('admin.form.Email'));
        $show->field('physical_address', __('admin.form.Physical address'));
        $show->field('district', __('admin.form.District'));
        $show->field('circle', __('admin.form.Circle'));
        $show->field('township', __('admin.form.Township'));
        $show->field('town_plot_number', __('admin.form.Town plot number'));
        $show->field('shop_number', __('admin.form.Shop number'));
        $show->field('company_name', __('admin.form.Company name'));
        $show->field('retailers_in', __('admin.form.Retailers in'));
        $show->field('business_registration_number', __('admin.form.Business registration number'));
        $show->field('years_in_operation', __('admin.form.Years in operation'));
        $show->field('business_description', __('admin.form.Business description'));
        $show->field('trading_license_number', __('admin.form.Trading license number'));
        $show->field('trading_license_period', __('admin.form.Trading license period'));
        $show->field('insuring_authority', __('admin.form.Insuring authority'));
        $show->field('attachments_certificate', __('admin.form.Attachments certificate'));
        $show->field('proof_of_payment', __('admin.form.Proof of payment'));
        $show->field('status', __('admin.form.Status'))->as(function ($status) {
            return \App\Models\Utils::tell_status($status) ?? '-';
        })->unescape();
      
        //disable the edit and delete action buttons
        $show->panel()->tools(function ($tools) {
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
        $form = new Form(new AgroDealers());
        $user = Admin::user();

        if ($form->isCreating()) 
        {
            $form->hidden('applicant_id')->default($user->id);
        }

        
        //check if the form is being edited
        if ($form->isEditing()) 
        {
                //get request id
               $id = request()->route()->parameters()['agro_dealer'];
              
               if($user->inRoles(['basic-user', 'agro-dealer'])){
                //check if the user is the owner of the form
                   $editable = Validation::checkUser('AgroDealers', $id);
                   if(!$editable){
                      $form->html(' <p class="alert alert-warning">You do not have rights to edit this form. <a href="/admin/agro-dealers"> Go Back </a></p> ');
                      $form->footer(function ($footer) 
                      {
  
                          // disable reset btn
                          $footer->disableReset();
  
                          // disable submit btn
                          $footer->disableSubmit();
                     });
                   }
                   //check if the form has been accepted
                   $editable_status = Validation::checkFormUserStatus('AgroDealers', $id);
                     if(!$editable_status){
                      $form->html(' <p class="alert alert-warning">You cannot edit this form because it has been accepted. <a href="/admin/agro-dealers"> Go Back </a></p> ');
                      $form->footer(function ($footer) 
                      {
      
                            // disable reset btn
                            $footer->disableReset();
      
                            // disable submit btn
                            $footer->disableSubmit();
                     });
                     }
               }
               elseif($user->isRole('inspector'))
                {
                   $editable = Validation::checkFormStatus('AgroDealers', $id);
                   
                    if(!$editable)
                    {
                        //return admin_error('You do not have rights to edit this form. <a href="/admin/seed-producers"> Go Back </a>');
                    
                        $form->html(' <p class="alert alert-warning">You do not have rights to edit this form. <a href="/admin/agro-dealers"> Go Back </a></p> ');
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
        //basic user
        if ($user->isRole('basic-user')) 
        {
          
            $form->text('first_name', __('admin.form.First name'));
            $form->text('last_name', __('admin.form.Last name'));
            $form->email('email', __('admin.form.Email'));
            $form->text('physical_address', __('admin.form.Physical address'));
            $form->text('district', __('admin.form.District'));
            $form->text('circle', __('admin.form.Circle'));
            $form->text('township', __('admin.form.Township'));
            $form->text('town_plot_number', __('admin.form.Town plot number'));
            $form->text('shop_number', __('admin.form.Shop number'));
            $form->text('company_name', __('admin.form.Company name'));
            $form->text('retailers_in', __('admin.form.Retailers in'));
            $form->text('business_registration_number', __('admin.form.Business registration number'));
            $form->number('years_in_operation', __('admin.form.Years in operation'));
            $form->textarea('business_description', __('admin.form.Business description'));
            $form->text('trading_license_number', __('admin.form.Trading license number'));
            $form->text('trading_license_period', __('admin.form.Trading license period'));
            $form->text('insuring_authority', __('admin.form.Insuring authority'));
            $form->file('attachments_certificate', __('admin.form.Attachments certificate'));
            $form->file('proof_of_payment', __('admin.form.Proof of payment'));
        }

        //admin, inspector and developer
        if ($user->inRoles(['commissioner', 'inspector','developer'])) 
        {

            $form->display('first_name', __('admin.form.First name'));
            $form->display('last_name', __('admin.form.Last name'));
            $form->display('email', __('admin.form.Email'));
            $form->display('physical_address', __('admin.form.Physical address'));
            $form->display('district', __('admin.form.District'));
            $form->display('circle', __('admin.form.Circle'));
            $form->display('township', __('admin.form.Township'));
            $form->display('town_plot_number', __('admin.form.Town plot number'));
            $form->display('shop_number', __('admin.form.Shop number'));
            $form->display('company_name', __('admin.form.Company name'));
            $form->display('retailers_in', __('admin.form.Retailers in'));
            $form->display('business_registration_number', __('admin.form.Business registration number'));
            $form->display('years_in_operation', __('admin.form.Years in operation'));
            $form->display('business_description', __('admin.form.Business description'));
            $form->display('trading_license_number', __('admin.form.Trading license number'));
            $form->display('trading_license_period', __('admin.form.Trading license period'));
            $form->display('insuring_authority', __('admin.form.Insuring authority'));
            $form->file('attachments_certificate', __('admin.form.Attachments certificate'));
            $form->file('proof_of_payment', __('admin.form.Proof of payment'));
            //admin decision
            if ($user->inRoles(['commissioner', 'developer'])) 
            {
                $form->divider(__('admin.form.Administartor decision'));
                $form->radioButton('status', __('admin.form.Status'))
                    ->options([
                        'accepted' =>__('admin.form.Accepted'),
                        'rejected' => __('admin.form.Rejected'),
                        'halted' => __('admin.form.Halted'),
                        'inspector assigned' => __('admin.form.Assign Inspector'),

                    ])
                    ->when('in', ['rejected', 'halted'], function (Form $form) {
                        $form->textarea('status_comment', __('admin.form.Status comment'))->required();
                    })
                    ->when('accepted', function (Form $form) {
                        $form->text('agro_dealer_reg_number', __('admin.form.Agro-dealer registration number'))->default('agrodealer'.'/'.rand(1000, 100000))->readonly();
                        $form->datetime('valid_from', __('admin.form.Agro-dealer approval date'))->default(date('Y-m-d H:i:s'))->required();
                        $form->datetime('valid_until', __('admin.form.Valid until'))->default(date('Y-m-d H:i:s'))->required();
                    })
                    ->when('inspector assigned', function (Form $form) {

                        //get all inspectors
                        $inspectors = \App\Models\Utils::get_inspectors();
                        $form->select('inspector_id', __('admin.form.Inspector'))
                            ->options($inspectors);
                    })->required();
            }
            //inspectors decision
            if ($user->isRole('inspector')) 
            {
                $form->divider(__('admin.form.Inspectors decision'));
                $form->radioButton('status', __('admin.form.Status'))
                    ->options([
                        'accepted' =>__('admin.form.Accepted'),
                        'rejected' => __('admin.form.Rejected'),
                        'halted' => __('admin.form.Halted'),
                        'inspector assigned' => __('admin.form.Assign Inspector'),
                    ])
                    ->when('in', ['rejected', 'halted'], function (Form $form) {
                        $form->textarea('status_comment', __('admin.form.Status comment'))->required();
                    })

                    ->when('accepted', function (Form $form) {
                        $form->text('agro_dealer_reg_number', __('admin.form.Agro-dealer registration number'))->default('agrodealer'.'/'.rand(1000, 100000))->readonly();
                        $form->datetime('valid_from', __('admin.form.Agro-dealer approval date'))->default(date('Y-m-d H:i:s'))->required();
                        $form->datetime('valid_until', __('admin.form.Valid until'))->default(date('Y-m-d H:i:s'))->required();
                    })->required();
            }
        }
        //disable the edit and delete action buttons
        $form->tools(function (Form\Tools $tools) {
            $tools->disableDelete();
            $tools->disableView();
        });
        return $form;
    }
}
