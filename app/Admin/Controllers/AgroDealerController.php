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
        
            $grid->disableBatchActions();
    
    
        //function to show the loggedin user only what belongs to them
        Validation::showUserForms($grid);

        //order in descending order
        $grid->model()->orderBy('id', 'desc');

         //disable action buttons appropriately
         Utils::disable_buttons('AgroDealers', $grid);

        //filter by cooperative name
        $grid->filter(function ($filter) 
        {
            // Remove the default id filter
            $filter->disableIdFilter();
            $filter->like('first_name', __('admin.form.First name'))->select(\App\Models\AgroDealers::pluck('first_name', 'first_name'));;
        });

        //disable create button 
        if ($user->inRoles(['agro-dealer'])) 
        {
            $grid->disableCreateButton();
        }
      
    
        $grid->column('agro_dealer_reg_number', __('admin.form.Agro-dealer registration number'))->display(function ($agro_dealer_reg_number) {
            return $agro_dealer_reg_number ?? 'Not yet assigned';
        })->sortable();
        $grid->column('first_name', __('admin.form.First name'));
        $grid->column('last_name', __('admin.form.Last name'));
        $grid->column('email', __('admin.form.Email'));
        $grid->column('category', __('admin.form.Agro Dealer Category'));
        $grid->column('physical_address', __('admin.form.Physical address'));
        $grid->column('region', __('admin.form.Region'));
        $grid->column('status', __('admin.form.Status'))->display(function ($status) {
            return Utils::tell_status($status)??'-';
        })->sortable();

      
        $grid->column('id', __('admin.form.Certificate'))->display(function ($id) {
            $agro_dealer =  AgroDealers::find($id);
        
            if ( $agro_dealer &&  $agro_dealer->status == 'accepted') {
                $link = url('agro_certificate?id=' . $id);
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
       
        $show->field('agro_dealer_reg_number', __('admin.form.Agro-dealer registration number'))->as(function ($value) {
            return $value ?? 'Not yet assigned';
        });
        $show->field('first_name', __('admin.form.First name'));
        $show->field('last_name', __('admin.form.Last name'));
        $show->field('email', __('admin.form.Email'));
        $show->field('telephone', __('admin.form.Telephone'));
        $show->field('physical_address', __('admin.form.Physical address'));
        $show->field('region', __('admin.form.Region'));
        $show->field('department', __('admin.form.Department'));
        $show->field('commune', __('admin.form.Commune'));
        $show->field('village', __('admin.form.Village'));
        $show->field('shop_number', __('admin.form.Shop number'));
        $show->field('company_name', __('admin.form.Company name'));
        $show->field('category', __('admin.form.Agro Dealer Category'));
        $show->field('retailers_in', __('admin.form.Retailer/Wholesaler in'));
        $show->field('business_registration_number', __('admin.form.Business registration number'));
        $show->field('years_in_operation', __('admin.form.Years in operation'));
        $show->field('business_description', __('admin.form.Business description'));
        $show->field('trading_license_number', __('admin.form.Trading license number'));
        $show->field('trading_license_period', __('admin.form.Trading license period'));
        $show->field('insuring_authority', __('admin.form.Insuring authority'));
        $show->field('attachments_certificate', __('admin.form.Certificate'))->as(function ($certificate) {
            return $certificate == null ? 'No file uploaded' : '<a href="/storage/' . $certificate . '" target="_blank">View certificate</a>';
        })->unescape();
        //$show->file('proof_of_payment', __('admin.form.Proof of payment'));
      
        $show->field('status', __('admin.form.Status'))->as(function ($status) {
            return Utils::tell_status($status) ?? '-';
        })->unescape();
        $show->field('status_comment', __('admin.form.Status comment'))->as(function ($value) {
            return $value ?? '-';
        });
      
        $show->field('valid_from', __('admin.form.Approval date'))->as(function ($value) {
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
            $id = request()->route()->parameters()['agro_dealer'];
             Validation::checkFormEditable($form, $id, 'AgroDealers');
        }

        
        if ($user->inRoles(['commissioner', 'inspector', 'developer'])) 
        {
            $form->display('first_name', __('admin.form.First name'));
            $form->display('last_name', __('admin.form.Last name'));
            $form->display('email', __('admin.form.Email'));
            $form->display('telephone', __('admin.form.Telephone'));
            $form->display('physical_address', __('admin.form.Physical address'));
            $form->display('region', __('admin.form.Region'));
            $form->display('department', __('admin.form.Department'));
            $form->display('commune', __('admin.form.Commune'));
            $form->display('village', __('admin.form.Village'));
            $form->display('shop_number', __('admin.form.Shop number'));
            $form->display('company_name', __('admin.form.Company name'));
            $form->display('category', __('admin.form.Agro Dealer Category'));
            $form->display('retailers_in', __('admin.form.Retailer/Wholesaler In'));
            $form->display('business_registration_number', __('admin.form.Business registration number'));
            $form->display('years_in_operation', __('admin.form.Years in operation'));
            $form->display('business_description', __('admin.form.Business description'));
            $form->display('trading_license_number', __('admin.form.Trading license number'));
            $form->display('trading_license_period', __('admin.form.Trading license period'));
            $form->display('insuring_authority', __('admin.form.Insuring authority'));
            $form->file('attachments_certificate', __('admin.form.Certificate'))->readonly();
            //$form->display('proof_of_payment', __('admin.form.Proof of payment'));
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
                        $form->text('agro_dealer_reg_number', __('admin.form.Agro-dealer registration number'))->default('DCCS/AGRO_DEALER/' . rand(1000, 100000).'/'. date('Y'))->required();
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
                $form->radio('status', __('admin.form.Status'))
                    ->options([
                        'recommended'=> __('admin.form.Recommend'),
                    
                    ])
                    ->when('recommended', function(Form $form){
                    $form->textarea('recommendation', __('Recommendation'))->required();
                    })->required();

            }
        } 

        else
        {
        
            $form->text('first_name', __('admin.form.First name'))->rules('required');
            $form->text('last_name', __('admin.form.Last name'))->rules('required');
            $form->text('telephone', __('admin.form.Telephone'))->rules('required');
            $form->email('email', __('admin.form.Email'))->rules('required|unique:agro_dealers,email');
            $form->text('physical_address', __('admin.form.Physical address'))->rules('required');
            $form->text('region', __('admin.form.Region'))->rules('required');
            $form->text('department', __('admin.form.Department'))->rules('required');
            $form->text('commune', __('admin.form.Commune'))->rules('required');
            $form->text('village', __('admin.form.Village'))->rules('required');
            $form->text('shop_number', __('admin.form.Shop number'))->rules('required');
            $form->text('company_name', __('admin.form.Company name'))->rules('required');
            $form->radio('category', __('admin.form.Agro Dealer Category'))
            ->options([
            'retailer' => 'Retailer',
            'wholesaler' => 'Wholesaler'
            ])->when('retailer', function(Form $form){
                $form->text('retailers_in', __('admin.form.Retailer in'))->rules('required');
                })
            ->when('wholesaler', function(Form $form){
                $form->text('retailers_in', __('admin.form.Wholesaler in'))->rules('required');
                })
            ->rules('required')
            ->default('retailers');
            
            $form->text('business_registration_number', __('admin.form.Business registration number'))->rules('required');
            $form->number('years_in_operation', __('admin.form.Years in operation'))->rules('required');
            $form->textarea('business_description', __('admin.form.Business description'))->rules('required');
            $form->text('trading_license_number', __('admin.form.Trading license number'))->rules('required');
            $form->text('trading_license_period', __('admin.form.Trading license period'))->rules('required');
            $form->text('insuring_authority', __('admin.form.Insuring authority'))->rules('required');
            $form->file('attachments_certificate', __('admin.form.Certificate'))->rules('required|mimes:pdf')->help('Upload a pdf file');
            //$form->file('proof_of_payment', __('admin.form.Proof of payment'))->rules('required|mimes:pdf,png,jpeg,jpg,')->help('Upload a pdf/png/jpeg/jpg file');
            $form->hidden('status')->default('pending');
            $form->hidden('inspector_id')->default('28');
        }

         //onsaved return to the list page
         $form->saved(function (Form $form) 
        {
            admin_toastr(__('admin.form.Form submitted successfully'), 'success');
            return redirect('/agro-dealers');
        });

        $form->html('<script>
    function toggleFields() {
        // Get the value of the selected radio button
        const category = document.querySelector(\'input[name="category\"]:checked\').value;

        // Get the input fields
        const retailerInput = document.querySelector("[name=\'retailer_in\']");
        const wholesalerInput = document.querySelector("[name=\'wholesaler_in\']");

        // Show/hide the input fields based on the selected category
        if (category === "retailers") {
            retailerInput.parentElement.style.display = "block"; // Show retailer input
            wholesalerInput.parentElement.style.display = "none"; // Hide wholesaler input
        } else {
            retailerInput.parentElement.style.display = "none"; // Hide retailer input
            wholesalerInput.parentElement.style.display = "block"; // Show wholesaler input
        }
    }

    // Call toggleFields on page load to set initial state
    document.addEventListener("DOMContentLoaded", function () {
        toggleFields(); // Set the initial state based on the default value
    });
</script>');

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
