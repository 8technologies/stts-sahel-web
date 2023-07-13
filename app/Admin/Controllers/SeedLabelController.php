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
        if(Admin::user()->isRole('labosem'))
        {
            $grid->model()->where('status', '=', 'accepted');
          
        }

       //disable create button and delete button for admin users
       if(!$user->inRoles(['basic-user','grower']))
       {
        
        $grid->disableCreateButton();
       
        }

        $grid->column('seed_label_request_number', __('Seed label request number'));
        $grid->column('applicant_id', __('Applicant name'));
        $grid->column('registration_number', __('Registration number'));
        $grid->column('label_packages', __('Label packages'));
        $grid->column('request_date', __('Request date'));
        if(!Admin::user()->isRole('labosem')){
        $grid->column('status', __('Status'))->display(function ($status) {
          return \App\Models\Utils::tell_status($status);
        });
        }
        //check the status of the form before displaying it to labosem
     
        $grid->actions(function ($actions) {
            $actions->disableDelete();  
            $actions->disableEdit();  
            
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
        $show = new Show(SeedLabel::findOrFail($id));
       
            $seed_label = SeedLabel::find($id);
            //get the users successfully registered seed labs
            $seed_lab = SeedLab::where('id', $seed_label->seed_lab_id)->first();
            $crop_declaration = LoadStock::where('id', $seed_lab->load_stock_id)->where('applicant_id', $seed_lab->applicant_id )->value('crop_declaration_id');
            //get crop variety from crop_declaration id
            $crop_variety_id = CropDeclaration::where('id', $crop_declaration)->value('crop_variety_id');
            //get crop variety name from crop_variety id
            $crop_variety= CropVariety::where('id', $crop_variety_id)->first();
            //get crop name from crop variety
            $crop_name = Crop::where('id', $crop_variety->crop_id)->value('crop_name');
        $show->field('seed_label_request_number', __('Seed label request number'));
        $show->field('applicant_id', __('Applicant name'))->as(function ($applicant_id) {
            return Administrator::where('id', $applicant_id)->value('name');
        });

        $show->field('id', __('Crop'))->as (function ($crop) use ($crop_name) {
            return $crop_name;
        });
        $show->field('a', __('Variety'))->as (function ($variety) use ($crop_variety) {
            return $crop_variety->crop_variety_name;
        });
        $show->field('', __('Generation'))-> as (function ($generation) use ($crop_variety) {
            return $crop_variety->crop_variety_generation;
        });
        $show->field('registration_number', __('Registration number'));
        $show->field('label_packages', __('Label packages'));
        $show->field('quantity_of_seed', __('Quantity of seed'));
        $show->file('proof_of_payment', __('Proof of payment'));
        $show->field('request_date', __('Request date'));
        $show->field('applicant_remarks', __('Applicant remarks'));

        //show the details in the pivot table
        $show->packages('Label packages', function ($packages) {
            $packages->resource('/admin/label-packages');
            $packages->package_id('Label package')->display(function ($package_id) {
                return LabelPackage::find($package_id)->quantity.'kgs'.' @ '.LabelPackage::find($package_id)->price;
            });

            $packages->quantity('Quantity');
              //add a print button with the package id as the id
              $packages->column('id', __('print'))->display(function ($id) {
                $link = url('label?id=' . $id);
           
                return '<a href="' . $link . '" class="btn btn-sm btn-success" target="_blank">Print</a>';
            });
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

        //disable the edit button and delete button
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
        $form = new Form(new SeedLabel());
        //get logged in user
        $user = Admin::user();
        if ($form->isCreating()) {
            $form->hidden('applicant_id')->default($user->id);
        }
         //get the users successfully registered seed labs
        $seed_lab_id = SeedLab::where('applicant_id', Auth::user()->id)->where('test_decision', 'marketable')->get();
      
        if($user->inRoles(['basic-user','grower'])){
    
        $form->select('seed_lab_id', __('Lot Number'))->options($seed_lab_id->pluck('lot_number', 'id'))->required();
        $form->text('seed_label_request_number', __('Seed label request number'));
        $form->text('registration_number', __('Registration number'));
        //$form->decimal('quantity_of_seed', __('Quantity of seed'));
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
           // $form->display('quantity_of_seed', __('Quantity of seed'));
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
                     $form->select('package_id', __('Label package'))->options($label_package_array)->required();
                 $form->display('quantity', __('Quantity'))->readonly();
     
             })->readonly();
            
        }

        if($user->isRole('labosem')){

            $form->select('status', __('Status'))->options(['printed' => 'Printed', 'rejected' => 'Rejected'])->default('pending');
        }

        if($user->isRole('commissioner')){

            $form->select('status', __('Status'))->options([ 'accepted' => 'Approved', 'rejected' => 'Rejected'])->default('pending');
        }
    }

    //disable delete button
    $form->tools(function (Form\Tools $tools) {
        $tools->disableView();
        $tools->disableDelete();
    });

        return $form;
    }
}
