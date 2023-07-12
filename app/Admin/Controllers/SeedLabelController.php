<?php

namespace App\Admin\Controllers;

use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use \App\Models\SeedLabel;
use \App\Models\SeedLab;
use \Encore\Admin\Facades\Admin;
use Encore\Admin\Auth\Database\Administrator;
use Illuminate\Support\Facades\Auth;
use \App\Models\CropVariety;
use \App\Models\Crop;
use \App\Models\SeedProducer;
use \App\Models\CropDeclaration;
use \App\Models\LoadStock;
use \App\Models\LabelPackage;


class SeedLabelController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'SeedLabel';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new SeedLabel());
        $user = Admin::user();
      
       //check the status of the form before displaying it to labosem
       if(Admin::user()->isRole('labosem')){
        $grid->model()->where('status', '=', 'approved');
       
    }

       //disable create button and delete button for admin users
       if(!$user->inRoles(['basic-user','grower'])){
        
        $grid->disableCreateButton();
        $grid->actions(function ($actions) {
            $actions->disableDelete();
           
            
        });
    }
        $grid->column('seed_label_request_number', __('Seed label request number'));
        $grid->column('applicant_id', __('Applicant name'));
        $grid->column('registration_number', __('Registration number'));
        $grid->column('label_packages', __('Label packages'));
        $grid->column('quantity_of_seed', __('Quantity of seed'));
        $grid->column('proof_of_payment', __('Proof of payment'));
        $grid->column('request_date', __('Request date'));
        
        
       

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
        $show = new Show(SeedLabel::findOrFail($id));
       
        $show->field('id', __('Id'));
        $show->field('seed_label_request_number', __('Seed label request number'));
        $show->field('applicant_id', __('Applicant name'));
        $show->field('registration_number', __('Registration number'));
        $show->field('seed_lab_id', __('Seed lab id'));
        $show->field('label_packages', __('Label packages'));
        $show->field('quantity_of_seed', __('Quantity of seed'));
        $show->field('proof_of_payment', __('Proof of payment'));
        $show->field('request_date', __('Request date'));
        $show->field('applicant_remarks', __('Applicant remarks'));

        //show the details in the pivot table
        $show->packages('Label packages', function ($packages) {
            $packages->resource('/admin/label-packages');
            $packages->id();
            $packages->package_id('Label package')->display(function ($package_id) {
                return LabelPackage::find($package_id)->quantity.'kgs'.' @ '.LabelPackage::find($package_id)->price;
            });
            $packages->quantity('Quantity');
            $packages->disableCreateButton();
            $packages->disableActions();
            $packages->disableRowSelector();
            $packages->disableExport();
            $packages->disableFilter();
            $packages->disablePagination();
            $packages->disableColumnSelector();
            $packages->disableTools();
            $packages->disableBatchActions();
            $packages->disablePerPageSelector();
            $packages->disableCreateButton();
            $packages->disableActions();
            $packages->disableRowSelector();
            $packages->disableExport();
            $packages->disableFilter();
            $packages->disablePagination();
            $packages->disableColumnSelector();
            $packages->disableTools();
            $packages->disableBatchActions();
            $packages->disablePerPageSelector();
            $packages->disableCreateButton();
            $packages->disableActions();
            $packages->disableRowSelector();
            $packages->disableExport();
            $packages->disableFilter();
            $packages->disablePagination();
            $packages->disableColumnSelector();
            $packages->disableTools();
            $packages->disableBatchActions();
            $packages->disablePerPageSelector();
            $packages->disableCreateButton();
            $packages->disableActions();
            $packages->disableRowSelector();
            $packages->disableExport();
            $packages->disableFilter();
            $packages->disablePagination();
            $packages->disableColumnSelector();
            $packages->disableTools();
            $packages->disableBatchActions();
            $packages->disablePerPageSelector();
            $packages->disableCreateButton();
            $packages->disableActions();
            $packages->disableRowSelector();
            $packages->disableExport();
            $packages->disableFilter();
            $packages->disablePagination();
            $packages->disableColumnSelector();
            $packages->disableTools();
            $packages->disableBatchActions();
            $packages->disablePerPageSelector();
            $packages->disableCreateButton();
            $packages->disableActions();
            $packages->disableRowSelector();
            $packages->disableExport();
            $packages->disableFilter();
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
        $form = new Form(new SeedLabel());
        //get logged in user
        $user = Admin::user();
        if ($form->isCreating()) {
            $form->hidden('applicant_id')->default($user->id);
        }
         //get the users successfully registered seed labs
        $seed_lab_id = SeedLab::where('applicant_id', Auth::user()->id)->where('test_decision', 'marketable')->get();
      
        if($user->inRoles(['basic-user','grower'])){
    
        $form->select('seed_lab_id', __('Seed lab id'))->options($seed_lab_id->pluck('seed_lab_test_report_number', 'id'))->required();
        $form->text('seed_label_request_number', __('Seed label request number'));
        $form->text('registration_number', __('Registration number'));
        $form->decimal('quantity_of_seed', __('Quantity of seed'));
        $form->file('proof_of_payment', __('Proof of payment'));
        $form->date('request_date', __('Request date'))->default(date('Y-m-d'));
        $form->textarea('applicant_remarks', __('Applicant remarks'));

        $form->text('label_packages', __('Label packages'));
        $form->hasMany('packages', __('Packages'), function (Form\NestedForm $form) {
           //drop down of the price and quantity from the label package table
              $label_package = LabelPackage::all();
                $label_package_array = [];
                foreach($label_package as $label){
                    $label_package_array[$label->id] = $label->quantity.'kgs'.' @ '.$label->price;
                }
               
            $form->select('package_id', __('Label package'))->options($label_package_array)->required();
            $form->number('quantity', __('Quantity'))->required();

          

        });
        }

        if($form->isEditing()){
            
            $form_id= request()->route()->parameters()['seed_label'];
            $seed_label = SeedLabel::find($form_id);
                //get the users successfully registered seed labs
                $seed_lab = SeedLab::where('id', $seed_label->seed_lab_id)->first();
                $crop_declaration = LoadStock::where('id', $seed_lab->load_stock_id)->where('applicant_id', $seed_lab->applicant_id )->value('crop_declaration_id');
                //get crop variety from crop_declaration id
                $crop_variety_id = CropDeclaration::where('id', $crop_declaration)->value('crop_variety_id');
                //get crop variety name from crop_variety id
                $crop_variety= CropVariety::where('id', $crop_variety_id)->first();
                //get crop name from crop variety
                $crop_name = Crop::where('id', $crop_variety->crop_id)->value('crop_name');

                $applicant_name = Administrator::where('id', $seed_lab->applicant_id)->value('name');

        if($user->inRoles(['commissioner','labosem'])){

            $form->display('seed_label_request_number', __('Seed label request number'));
            $form->display('registration_number', __('Registration number'));
            $form->display('', __('Applicant name'))->default($applicant_name);
            $form->display('', __('Crop'))->default($crop_name);
            $form->display('', __('Variety'))->default($crop_variety->crop_variety_name);
            $form->display('', __('Generation'))->default($crop_variety->crop_variety_generation);
            $form->display('label_packages', __('Label packages'));
            $form->display('quantity_of_seed', __('Quantity of seed'));
            $form->display('proof_of_payment', __('Proof of payment'));
            $form->display('request_date', __('Request date'))->default(date('Y-m-d'));
            $form->display('applicant_remarks', __('Applicant remarks'));
            $form->hasMany('packages', __('Packages'), function (Form\NestedForm $form) {
                //drop down of the price and quantity from the label package table
                   $label_package = LabelPackage::all();
                     $label_package_array = [];
                     foreach($label_package as $label){
                         $label_package_array[$label->id] = $label->quantity.'kgs'.' @ '.$label->price;
                     }
                     $form_id= request()->route()->parameters()['seed_label'];
                     $seed_label = SeedLabel::find($form_id); 
                 $form->select('package_id', __('Label package'))->readonly();
                 $form->display('quantity', __('Quantity'))->readonly();
                 $link = url('label?id=' . $seed_label->id);
           
             //add a print button
                $form->html('<a href="' . $link . '" class="btn btn-sm btn-success" target="_blank">Print</a>', __('Print'));
               
     
             })->readonly();
            
        }

        if($user->isRole('labosem')){

            $form->select('status', __('Status'))->options(['printed' => 'Printed', 'rejected' => 'Rejected', 'pending' => 'Pending'])->default('pending');
        }

        if($user->isRole('commissioner')){

            $form->select('status', __('Status'))->options(['pending' => 'Pending', 'approved' => 'Approved', 'rejected' => 'Rejected'])->default('pending');
        }
    }

        return $form;
    }
}
