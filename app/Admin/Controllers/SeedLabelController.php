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

        //check the status of the form before displaying it to labosem
        if(Admin::user()->isRole('labosem')){
            $grid->model()->where('status', '=', 'approved');
        }
      ;
                
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
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

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
        $form->text('label_packages', __('Label packages'));
        $form->decimal('quantity_of_seed', __('Quantity of seed'));
        $form->text('proof_of_payment', __('Proof of payment'));
        $form->date('request_date', __('Request date'))->default(date('Y-m-d'));
        $form->textarea('applicant_remarks', __('Applicant remarks'));
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
