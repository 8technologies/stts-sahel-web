<?php

namespace App\Admin\Controllers;

use App\Models\LoadStock;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use \Encore\Admin\Facades\Admin;
use Encore\Admin\Auth\Database\Administrator;
use \App\Models\SeedLab;
use \App\Models\CropDeclaration;
use \App\Models\CropVariety;
use \App\Models\Crop;


class SeedLabController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'SeedLab';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new SeedLab());

        //ensure that a user only sees what he is supposed to
        if (!auth('admin')->user()->isRole('commissioner')) {

            if (!auth('admin')->user()->isRole('inspector')) {
                $grid->model()->where('applicant_id', auth('admin')->user()->id);
            } else {
                $grid->model()->where('inspector_id', auth('admin')->user()->id);
            }
        }

        //show an empty table if the status is not lab inspection assigned
        
      

        $grid->column('id', __('Id'));
        $grid->column('sample_request_number', __('Sample request number'));
        $grid->column('applicant_id', __('Applicant id'));
        $grid->column('load_stock_number', __('Load stock number'));
        $grid->column('sample_request_date', __('Sample request date'));
        $grid->column('proof_of_payment', __('Proof of payment'));
        $grid->column('applicant_remarks', __('Applicant remarks'));
        $grid->column('seed_lab_test_report_number', __('Seed lab test report number'));
        $grid->column('seed_sample_request_number', __('Seed sample request number'));
        $grid->column('seed_sample_size', __('Seed sample size'));
        $grid->column('testing_methods', __('Testing methods'));
        $grid->column('germination_test_results', __('Germination test results'));
        $grid->column('purity_test_results', __('Purity test results'));
        $grid->column('moisture_content_test_results', __('Moisture content test results'));
        $grid->column('additional_tests_results', __('Additional tests results'));
        $grid->column('test_decision', __('Test decision'));
        $grid->column('reporting_and_signature', __('Reporting and signature'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

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
        $show = new Show(SeedLab::findOrFail($id));

        $show->field('id', __('Id'));
    
        $show->field('applicant_id', __('Applicant id'));
        $show->field('load_stock_number', __('Load stock number'));
        $show->field('seed_lab_test_report_number', __('Seed lab test report number'));
        $show->field('seed_sample_request_number', __('Seed sample request number'));
        $show->field('seed_sample_size', __('Seed sample size'));
        $show->field('testing_methods', __('Testing methods'));
        $show->field('germination_test_results', __('Germination test results'));
        $show->field('purity_test_results', __('Purity test results'));
        $show->field('moisture_content_test_results', __('Moisture content test results'));
        $show->field('additional_tests_results', __('Additional tests results'));
        $show->field('test_decision', __('Test decision'));
        $show->field('reporting_and_signature', __('Reporting and signature'));
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
        $form = new Form(new SeedLab());

        //get looged in user
        $user = Admin::user();
        if ($form->isCreating()) {
            $form->hidden('applicant_id')->default($user->id);
        }

        $crop_stock = LoadStock::where('applicant_id', $user->id);
        
             
        if($form->isEditing()){
            $form_id= request()->route()->parameters()['seed-lab'];
            $form = SeedLab::find($form_id);
            $crop_declaration = LoadStock::where('id', $form->load_stock_id)->where('applicant_id', $form->applicant_id )->value('crop_declaration_id');
            //get crop variety from crop_declaration id
            $crop_variety_id = CropDeclaration::where('id', $crop_declaration)->value('crop_variety_id');
            //get crop variety name from crop_variety id
            $crop_variety= CropVariety::where('id', $crop_variety_id);
            //get crop name from crop variety
            $crop_name = Crop::where('id', $crop_variety->crop_id)->value('name');

            
            $form->text('applicant_id', __('Applicant name'));
            $form->text('load_stock_id', __('Load stock number'))->readonly();
            $form->display('', __('Crop'))->default($crop_name);
            $form->select('priority', __('Priority'))->options(['low' => 'Low', 'medium' => 'Medium', 'high' => 'High']);
        

        $form->text('seed_lab_test_report_number', __('Seed lab test report number'));
        $form->text('seed_sample_request_number', __('Seed sample request number'));
        $form->decimal('seed_sample_size', __('Seed sample size'));
        $form->text('testing_methods', __('Testing methods'));
        $form->decimal('germination_test_results', __('Germination test results'));
        $form->decimal('purity_test_results', __('Purity test results'));
        $form->decimal('moisture_content_test_results', __('Moisture content test results'));
        $form->textarea('additional_tests_results', __('Additional tests results'));
        $form->text('test_decision', __('Test decision'));
        $form->textarea('reporting_and_signature', __('Reporting and signature'));
    }
        return $form;
    }
}
