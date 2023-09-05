<?php

namespace App\Admin\Controllers;

use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Facades\Admin;
use App\Models\Utils;
use App\Models\Validation;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;


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
        $agro_dealers = AgroDealers::where('user_id', auth('admin')->user()->id)->get();;
        $user = Admin::user();
        //function to show the loggedin user only what belongs to them
        Validation::showUserForms($grid);

        //order of table
        $grid->model()->orderBy('id', 'desc');

        //disable action buttons appropriately
        Utils::disable_buttons('AgroDealers', $grid);

        //disable create button 
        if($user->inRoles(['agro-dealer'])) 
        {
            $grid->disableCreateButton();
        }

       //filter by name
       $grid->filter(function ($filter) 
       {
        // Remove the default id filter
        $filter->disableIdFilter();
        $filter->like('user_id', 'Applicant')->select(\App\Models\User::pluck('name', 'id'));
       
       });

        $grid->column('agro_dealer_reg_number', __('admin.form.Agro-dealer registration number'))->display(function ($value) {
            return $value ?? '-';
        })->sortable();
        $grid->column('first_name', __('admin.form.First name'));
        $grid->column('last_name', __('admin.form.Last name'));
        $grid->column('email', __('admin.form.Email address'));
        $grid->column('physical_address', __('admin.form.Physical address'));
        $grid->column('status', __('admin.form.Status'))->display(function ($status) {
            return \App\Models\Utils::tell_status($status)??'-';
        })->sortable();

        //check user role then show a certificate button
        if(!auth('admin')->user()->isRole('inspector'))
        {

            $grid->column('id', __('admin.form.Certificate'))->display(function ($id) use ( $agro_dealers) {
            
            $agro_dealer = $agro_dealers->firstWhere('id', $id);
            
                if ($agro_dealer&& $agro_dealer->status == 'accepted') {
                    $link = url('agro_certificate?id=' . $id);
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
        $show = new Show(AgroDealers::findOrFail($id));
          //delete notification after viewing the form
          Utils::delete_notification('AgroDealers', $id);

          //check if the user is the owner of the form
          $showable = Validation::checkUser('AgroDealers', $id);
          if (!$showable) 
          {
              return(' <p class="alert alert-danger">You do not have rights to view this form. <a href="/admin/agro-dealers"> Go Back </a></p> ');
          }
  

        $show->field('agro_dealer_reg_number', __('admin.form.Agro-dealer registration number'));
        $show->field('first_name', __('admin.form.First name'));
        $show->field('last_name', __('admin.form.Last name'));
        $show->field('email', __('admin.form.Email address'));
        $show->field('physical_address', __('admin.form.Physical address'));
        $show->field('district', __('admin.form.District'));
        $show->field('circle', __('admin.form.Circle'));
        $show->field('township', __('admin.form.Township'));
        $show->field('town_plot_number', __('admin.form.Town/plot number'));
        $show->field('shop_number', __('admin.form.Shop number'));
        $show->field('company_name', __('admin.form.Company name'));
        $show->field('retailers_in', __('admin.form.Retailers in'));
        $show->field('business_registration_number', __('admin.form.Business registration number'));
        $show->field('years_in_operation', __('admin.form.Years in operation'));
        $show->field('business_description', __('admin.form.Business description'));
        $show->field('trading_license_number', __('admin.form.Trading license number'));
        $show->field('trading_license_period', __('admin.form.Trading license period'));
        $show->field('insuring_authority', __('admin.form.Insuring authority'));
        $show->field('attachments_certificate', __('admin.form.Attachments (certificate)'));
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

        //When form is creating, assign user id
        if ($form->isCreating()) 
        {
            $form->hidden('user_id')->default($user->id);
        }

        
        //check if the form is being edited
        if ($form->isEditing()) 
        {
            //get request id
            $id = request()->route()->parameters()['agro_dealer'];
            //check if its valid to edit the form
            Validation::checkFormEditable($form, $id, 'AgroDealers');
            
        }

        //onsaved return to the list page
        $form->saved(function (Form $form) 
        {
            admin_toastr(__('admin.form.Form submitted successfully'), 'success');
            return redirect('/admin/agro-dealers');
        });

        //basic user
        if ($user->isRole('basic-user')) 
        {
          
            $form->text('first_name', __('admin.form.First name'))->required();
            $form->text('last_name', __('admin.form.Last name'))->required();
            $form->email('email', __('admin.form.Email address'))->required();
            $form->text('physical_address', __('admin.form.Physical address'))->required();
            $form->text('district', __('admin.form.District/Region'))->required();
            $form->text('circle', __('admin.form.Circle'))->required();
            $form->text('township', __('admin.form.Township'))->required();
            $form->text('town_plot_number', __('admin.form.Town/Plot number'))->required();
            $form->text('shop_number', __('admin.form.Shop number'))->required();
            $form->text('company_name', __('admin.form.Company name'))->required();
            $form->text('retailers_in', __('admin.form.Retailers in'))->required();
            $form->text('business_registration_number', __('admin.form.Business registration number'))->required();
            $form->number('years_in_operation', __('admin.form.Years in operation'))->required();
            $form->textarea('business_description', __('admin.form.Business description'))->required();
            $form->text('trading_license_number', __('admin.form.Trading license number'))->required();
            $form->text('trading_license_period', __('admin.form.Trading license period'))->required();
            $form->text('insuring_authority', __('admin.form.Insuring authority'))->required();
            $form->file('attachments_certificate', __('admin.form.Attachments (certificate)'))
            ->rules(['mimes:pdf', 'max:2048']) // Assuming a maximum file size of 2MB 
            ->help('Attach a copy of your certificate, and should be in pdf format')
            ->required();
            $form->file('proof_of_payment', __('admin.form.Proof of payment'))
            ->rules(['mimes:jpeg,pdf,jpg', 'max:2048']) // Assuming a maximum file size of 2MB 
            ->help('Attach a copy of your proof of payment, and should be in pdf, jpg or jpeg format')
            ->required();
            
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
                        $form->textarea('status_comment', __('admin.form.Status comment'))->rules('required');
                    })
                    ->when('accepted', function (Form $form) {
                        $form->text('agro_dealer_reg_number', __('admin.form.Agro-dealer registration number'))->default('agrodealer'.'/'.rand(1000, 100000))->readonly();
                        $form->datetime('valid_from', __('admin.form.Agro-dealer approval date'))->default(date('Y-m-d H:i:s'))->required();
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
                            ->options($inspectors)->rules('required');
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
                        
                    ])
                    ->when('in', ['rejected', 'halted'], function (Form $form) {
                        $form->textarea('status_comment', __('admin.form.Status comment'))->rules('required');
                    })

                    ->when('accepted', function (Form $form) {
                        $form->text('agro_dealer_reg_number', __('admin.form.Agro-dealer registration number'))->default('agrodealer'.'/'.rand(1000, 100000))->readonly();
                        $form->datetime('valid_from', __('admin.form.Agro-dealer approval date'))->default(date('Y-m-d H:i:s'))->required();
                        $nextYear = Carbon::now()->addYear(); // Get the date one year from now
                        $defaultDateTime = $nextYear->format('Y-m-d H:i:s'); // Format the date for default value
                        
                        $form->datetime('valid_until', __('admin.form.Valid until'))
                            ->default($defaultDateTime)
                            ->required();
                    })->required();
            }
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
