<?php

namespace App\Admin\Controllers;

use App\Models\AgroDealers;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Facades\Admin;
use \App\Models\Validation;
use \App\Models\Utils;
use Carbon\Carbon;



class AgroDealerController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */

     protected function title()
     {
         return trans('admin.form.Agro-dealer Registration');
     }
 
 

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {

        $grid = new Grid(new AgroDealers());
        $user = Admin::user();

         
        //hide details from other farmer roles
        if(!$user->inRoles(['agro-dealer','developer','inspector','commissioner','basic-user']))
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
            $filter->like('first_name', __('admin.form.First name'));
        });

        //disable create button 
        if ($user->inRoles(['agro-dealer'])) 
        {
            $grid->disableCreateButton();
        }
      
    
        $grid->column('agro_dealer_reg_number', __('admin.form.Agro-dealer registration number'));
        $grid->column('first_name', __('admin.form.First name'));
        $grid->column('last_name', __('admin.form.Last name'));
        $grid->column('email', __('admin.form.Email'));
        $grid->column('physical_address', __('admin.form.Physical address'));
        $grid->column('district', __('admin.form.District'));
        $grid->column('status', __('admin.form.Status'))->display(function ($status) {
            return Utils::tell_status($status)??'-';
        })->sortable();

      
        $grid->column('id', __('admin.form.Certificate'))->display(function ($id) {
            $agro_dealer =  AgroDealers::find($id);
        
            if ( $agro_dealer &&  $agro_dealer->status == 'accepted') {
                $link = url('agro-dealer?id=' . $id);
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
        $show = new Show(AgroDealers::findOrFail($id));

         //delete notification after viewing the form
         Utils::delete_notification('AgroDealers', $id);

         //check if the user is the owner of the form
         $showable = Validation::checkUser('AgroDealers', $id);
         if (!$showable) 
         {
             return('<p class="alert alert-danger">You do not have rights to view this form. <a href="/agro-dealers"> Go Back </a></p> ');
         }
       
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
        $show->field('inspector_id', __('admin.form.Inspector'))->as(function ($inspector_id) {
            return Utils::get_inspector_name($inspector_id) ?? '-'; 
        });

       
        $show->field('status', __('admin.form.Status'))->as(function ($status) {
            return Utils::tell_status($status) ?? '-';
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
        $form = new Form(new AgroDealers());

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
            $id = request()->route()->parameters()['agro-dealer'];
             Validation::checkFormEditable($form, $id, 'AgroDealers');
        }

         //onsaved return to the list page
         $form->saved(function (Form $form) 
        {
            admin_toastr(__('admin.form.Form submitted successfully'), 'success');
            return redirect('/agro-dealers');
        });

        
        if ($user->inRoles(['commissioner', 'inspector', 'developer'])) 
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
            $form->display('attachments_certificate', __('admin.form.Attachments certificate'));
            $form->display('proof_of_payment', __('admin.form.Proof of payment'));
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

                        $form->text('agro_dealer_reg_number', __('admin.form.Agro-dealer registration number'))->default('agro_dealer'.'/'.rand(1000, 10000).'/'. $year )->required();
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
           
            //inspectors decision
            if ($user->isRole('inspector')) 
            {
            
                $form->divider('Inspectors decision');
                $form->radio('status', __('admin.form.Status'))
                    ->options([
                        'recommended'=> __('admin.form.Recommend'),
                    
                    ])
                    ->when('recommended', function(Form $form){
                    $form->textarea('recommendation', __('Recommendation'));
                    });

            }
        } 

        
        $form->text('agro_dealer_reg_number', __('Agro dealer reg number'));
        $form->text('first_name', __('First name'));
        $form->text('last_name', __('Last name'));
        $form->email('email', __('Email'));
        $form->text('physical_address', __('Physical address'));
        $form->text('district', __('District'));
        $form->text('circle', __('Circle'));
        $form->text('township', __('Township'));
        $form->text('town_plot_number', __('Town plot number'));
        $form->text('shop_number', __('Shop number'));
        $form->text('company_name', __('Company name'));
        $form->text('retailers_in', __('Retailers in'));
        $form->text('business_registration_number', __('Business registration number'));
        $form->number('years_in_operation', __('Years in operation'));
        $form->textarea('business_description', __('Business description'));
        $form->text('trading_license_number', __('Trading license number'));
        $form->text('trading_license_period', __('Trading license period'));
        $form->text('insuring_authority', __('Insuring authority'));
        $form->text('attachments_certificate', __('Attachments certificate'));
        $form->text('proof_of_payment', __('Proof of payment'));
        $form->hidden('status')->default('pending');
        $form->hidden('inspector_id')->default(null);

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
