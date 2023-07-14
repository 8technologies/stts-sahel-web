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
        $user = Admin::user();
        $lab_results = SeedLab::where('applicant_id', auth('admin')->user()->id)->value('test_decision');
        //check the status of the form before displaying it
        $grid->model()->where('status', '=', 'lab test assigned');

        //disable create button
        $grid->disableCreateButton();

        //disable edit for all users apart from lab technician
        if(!$user->isRole('lab_technician')){
            $grid->actions(function ($actions) {
                $actions->disableDelete();
                $actions->disableEdit();
                
            });
        }

        $grid->actions(function ($actions) {
            $actions->disableDelete();
        });

        $grid->column('lot_number', __('Lot Number'))->display(function ($lot_number) {
            return $lot_number??'Not yet assigned';
        });
        $grid->column('applicant_id', __('Applicant'))->display(function ($applicant_id) {
            return \App\Models\User::find($applicant_id)->name;
        });
       
        $grid->column('seed_lab_test_report_number', __('Seed lab test report number'))->display(function ($seed_lab_test_report_number) {
            return $seed_lab_test_report_number??'Not yet assigned';
        });
        $grid->column('germination_test_results', __('Germination test results'))->display(function ($germination_test_results) {
            return $germination_test_results??'Not yet assigned';
        });
        $grid->column('purity_test_results', __('Purity test results'))->display(function ($purity_test_results) {
            return $purity_test_results??'Not yet assigned';
        });
        $grid->column('test_decision', __('Test decision'))->display(function ($test_decision) {
           
            return \App\Models\Utils::tell_status($test_decision)??'Not yet assigned';
        });
        if($lab_results != null ){
            $grid->column('id', __('admin.form.Print Results'))->display(function ($id) {
                $link = url('lab_results?id=' . $id);
                return '<b><a target="_blank" href="' . $link . '">Print Results</a></b>';
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
        $show = new Show(SeedLab::findOrFail($id));

      
    
        $show->field('applicant_id', __('Applicant'))->as(function ($applicant_id) {
            return \App\Models\User::find($applicant_id)->name;
        });
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

        //disable edit button 
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
        $form = new Form(new SeedLab());

        //get looged in user
        $user = Admin::user();
        if ($form->isCreating()) {
            $form->hidden('applicant_id')->default($user->id);
        }

        $crop_stock = LoadStock::where('applicant_id', $user->id);
        
             
        if($form->isEditing()){
           
            $form_id= request()->route()->parameters()['seed_lab_test'];
            $seed_lab = SeedLab::find($form_id);
           
            $crop_declaration = LoadStock::where('id', $seed_lab->load_stock_id)->where('applicant_id', $seed_lab->applicant_id )->value('crop_declaration_id');
            //get crop variety from crop_declaration id
            $crop_variety_id = CropDeclaration::where('id', $crop_declaration)->value('crop_variety_id');
            //get mother_lot from crop_declaration
            $mother_lot = CropDeclaration::where('id', $crop_declaration)->value('source_lot_number');
            //get crop variety name from crop_variety id
            $crop_variety= CropVariety::where('id', $crop_variety_id)->first();
            //get crop name from crop variety
            $crop_name = Crop::where('id', $crop_variety->crop_id)->value('crop_name');

            $applicant_name = Administrator::where('id', $seed_lab->applicant_id)->value('name');

     
                $form->display('', __('Applicant name'))->default($applicant_name);
                $form->display('load_stock_id', __('Load stock number'))->readonly();
                $form->display('', __('Crop'))->default($crop_name);
                $form->display('', __('Variety'))->default($crop_variety->crop_variety_name);
                $form->display('', __('Generation'))->default($crop_variety->crop_variety_generation);
                
        $form->hidden('mother_lot')->default($mother_lot);
        $form->text('seed_lab_test_report_number', __('Seed lab test report number'))->default('labtest'. "/". mt_rand(10000000, 99999999));
        $form->text('seed_sample_request_number', __('Seed sample request number'));
        $form->decimal('seed_sample_size', __('Seed sample size'));
        $form->text('testing_methods', __('Testing methods'));
        $form->decimal('germination_test_results', __('Germination test results'));
        $form->decimal('purity_test_results', __('Purity test results'));
        $form->decimal('moisture_content_test_results', __('Moisture content test results'));
        $form->textarea('additional_tests_results', __('Additional tests results'));
        $form->radio('test_decision', __('Test decision'))
        ->options(['marketable' => 'Marketable', 'not marketable' => 'Not Marketable'])
        ->when('marketable', function (Form $form) use ($crop_variety) {
            $form->textarea('lot_number', __('Lot number'))->default($crop_variety->crop_variety_name. "/". mt_rand(10000000, 99999999));
        });
        $form->textarea('reporting_and_signature', __('Reporting and signature'));
    }

    //disable edit and delete buttons
    $form->tools(function (Form\Tools $tools) {
        $tools->disableDelete();
        $tools->disableView();
    });
    
        return $form;
    }
}
