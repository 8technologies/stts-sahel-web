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
use \App\Models\SeedClass;
use \App\Models\Validation;
use \App\Models\Utils;



class SeedLabController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected function title()
    {
        return trans('admin.form.Seed Lab Test');
    }


    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new SeedLab());
        $user = Admin::user();
        $lab_results = SeedLab::where('user_id', auth('admin')->user()->id)->get();
        //check the status of the form before displaying it
       
        if($user->inRoles(['grower','cooperative','individual-producers','research'])){
          $grid->model()->where('user_id', '=', $user->id)->where('status', '=', 'lab test assigned');
         }else{
            $grid->model()->where('status', '!=', 'pending');
         }

         //order in descending order;
         $grid->model()->orderBy('id', 'desc');

        //disable batch and export actions
        Utils::disable_batch_actions($grid);

        //filter by name
        $grid->filter(function ($filter) 
        {
            // Remove the default id filter
            $filter->disableIdFilter();
            $filter->like('user_id', 'Applicant')->select(\App\Models\User::pluck('name', 'id'));
            
        });

        //disable create button
        $grid->disableCreateButton();

        //disable edit for all users apart from lab technician
        if (!$user->isRole('lab_technician')) {
            $grid->actions(function ($actions) {
                $actions->disableDelete();
                $actions->disableEdit();
            });
        }else{
            $grid->actions(function ($actions) {
                $actions->disableDelete();
            });
        }

        $grid->column('lot_number', __('admin.form.Lot Number'))->display(function ($lot_number) {
            return $lot_number ?? __('admin.form.Not yet assigned');
        });
        $grid->column('user_id', __('admin.form.Applicant'))->display(function ($user_id) {
            return \App\Models\User::find($user_id)->name;
        });

        $grid->column('seed_lab_test_report_number', __('admin.form.Seed lab test report number'))->display(function ($seed_lab_test_report_number) {
            return $seed_lab_test_report_number ??__('admin.form.Not yet assigned');
        });
        $grid->column('germination_test_results', __('admin.form.Germination test results'))->display(function ($germination_test_results) {
            return $germination_test_results ?? __('admin.form.Not yet assigned');
        });
        $grid->column('purity_test_results', __('admin.form.Purity test results'))->display(function ($purity_test_results) {
            return $purity_test_results ?? __('admin.form.Not yet assigned');
        });
        $grid->column('test_decision', __('admin.form.Test decision'))->display(function ($test_decision) {

            return \App\Models\Utils::tell_status($test_decision) ?? __('admin.form.Not yet assigned');
        });
       
        //check user role then show a certificate button
        if(!auth('admin')->user()->inRoles(['inspector','commissioner']))
        {

            $grid->column('id', __('admin.form.Print results'))->display(function ($id) use ( $lab_results) {
                $lab_result =  $lab_results->firstWhere('id', $id);
            
                if ($lab_result && $lab_result->test_decision == 'marketable') {
                    $link = url('lab_results?id=' . $id);
                    return '<b><a target="_blank" href="' . $link . '">Imprimer les résultats</a></b>';
                } else {
                   
                    return '<b>Résultats Indisponibles</b>';
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
        $show = new Show(SeedLab::findOrFail($id));
        //delete notification after viewing the form
        Utils::delete_notification('SeedLab', $id);

        //check if the user is the owner of the form
        $showable = Validation::checkUser('SeedLab', $id);
        if (!$showable) 
        {
            return(' <p class="alert alert-danger">You do not have rights to view this form. <a href="/seed-producers"> Go Back </a></p> ');
        }


        $seed_lab = SeedLab::find($id);
        $crop_variety_id = $seed_lab->crop_variety_id;
        
        $load_stock_id = $seed_lab->load_stock_id;

        $show->field('user_id', __('admin.form.Applicant'))->as(function ($user_id) {
            return \App\Models\User::find($user_id)->name;
        });
        $show->field('load_stock_id', __('admin.form.Crop stock number'))->as(function ($load_stock_id) {
            return \App\Models\LoadStock::find($load_stock_id)->load_stock_number;
        });
        $show->field('c', __('admin.form.Crop'))->as(function () use ($crop_variety_id) {
            $crop_id = \App\Models\CropVariety::find($crop_variety_id)->crop_id;
            return \App\Models\Crop::find($crop_id)->crop_name;
        });

        $show->field('crop_variety_id', __('admin.form.Crop Variety'))->as(function ($crop_variety_id) {
            return \App\Models\CropVariety::find($crop_variety_id)->crop_variety_name;
        });

        $show->field('', __('Generation'))->as(function () use ($load_stock_id) {
            $seed_class_id = \App\Models\LoadStock::find($load_stock_id)->seed_class;
            return \App\Models\SeedClass::find($seed_class_id)->class_name;
        });
        $show->field('seed_lab_test_report_number', __('admin.form.Seed lab test report number'));
        $show->field('sample_request_number', __('admin.form.Seed sample request number'));
        $show->field('seed_sample_size', __('admin.form.Seed sample size'));

       
        $show->field('testing_methods', __('admin.form.Testing method'))->as(function ($testingMethods) {
            // Return the formatted methods as a list without the square brackets and quotes
            $methods = str_replace(['[', ']', '"'], '', $testingMethods);
            return $methods;
        });
 
        $show->field('germination_test_results', __('admin.form.Germination test results(%)'))->as(function ($germination_test_results) {
            return $germination_test_results ??__('admin.form.Not yet assigned');
        })->unescape();
        $show->field('purity_test_results', __('admin.form.Purity test results(%)'))->as(function ($purity_test_results) {
            return $purity_test_results ?? __('admin.form.Not yet assigned');
        })->unescape();
        $show->field('moisture_content_test_results', __('admin.form.Moisture content test results(%)'))->as(function ($moisture_content_test_results) {
            return $moisture_content_test_results ?? __('admin.form.Not yet assigned');
        })->unescape();
        $show->field('additional_tests_results', __('admin.form.Additional tests results'));
        $show->field('test_decision', __('admin.form.Test decision'))->as(function ($test_decision) {
            return \App\Models\Utils::tell_status($test_decision)?? 'Not yet assigned';
        })->unescape();
        $show->field('reporting_and_signature', __('admin.form.Reporting and signature'));
       

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
       
        if ($form->isEditing()) 
        {
               //check if the user is a lab technician
            if (!$user->isRole('lab_technician')) 
            {
                  $form->html('<p class="alert alert-danger">' . __('admin.form.no rights to edit') . '</p>');
                    $form->footer(function ($footer) 
                    {

                        // disable reset btn
                        $footer->disableReset();

                        // disable submit btn
                        $footer->disableSubmit();
                    });
            }


            $form_id = request()->route()->parameters()['seed_lab_test'];
            $seed_lab = SeedLab::find($form_id); 
            $crop_declaration = LoadStock::where('id', $seed_lab->load_stock_id)->where('user_id', $seed_lab->user_id)->value('crop_declaration_id');

            if($crop_declaration != null)
            {
               
                //get crop variety from crop_declaration id
                $crop_variety_id = CropDeclaration::where('id', $crop_declaration)->value('crop_variety_id');
                //get mother_lot from crop_declaration
                $mother_lot = CropDeclaration::where('id', $crop_declaration)->value('source_lot_number');
                //get crop variety name from crop_variety id
                $crop_variety = CropVariety::where('id', $crop_variety_id)->first();
                //get crop name from crop variety
                $crop = Crop::find($crop_variety->crop_id);
                $load_stock = LoadStock::where('id', $seed_lab->load_stock_id)->first();

                $applicant_name = Administrator::where('id', $seed_lab->user_id)->value('name');
                $seed_class = SeedClass::where('id', $load_stock->seed_class)->value('class_name');

                $form->display('', __('admin.form.Applicant name'))->default($applicant_name);
                $form->display('', __('admin.form.Crop stock number'))->default($load_stock->load_stock_number);
                $form->display('', __('admin.form.Crop'))->default($crop->crop_name);
                $form->display('', __('admin.form.Variety'))->default($crop_variety->crop_variety_name);
                $form->display('', __('Generation'))->default($seed_class);
                $form->display('quantity', __('admin.form.Seed Sample size(kgs)'));
                $form->hidden('crop_variety_id', __('admin.form.Crop Variety'))->default($crop_variety->id);
                $form->text('mother_lot',__('admin.form.Mother lot number'))->default($mother_lot)->readonly();

            }
            else
            {

                  //get crop variety from crop_declaration id
                  $crop_variety_id = CropDeclaration::where('id', $crop_declaration)->value('crop_variety_id');
              
                  $load_stock = LoadStock::find($seed_lab->load_stock_id);
                  
                  //get crop variety name from crop_variety id
                  $crop_variety = CropVariety::where('id', $load_stock->crop_variety_id)->first();
                  //get crop name from crop variety
                  $crop = Crop::find($crop_variety->crop_id);
                  $crop_name = $crop->crop_name;
                  //get applicant name
                  $applicant_name = Administrator::where('id', $seed_lab->user_id)->value('name');
                  //get seed class name
                  $seed_class = SeedClass::where('id',$load_stock->seed_class)->value('class_name');

                  $form->display('', __('admin.form.Applicant name'))->default($applicant_name);
                  $form->display('', __('admin.form.Crop stock number'))->default($load_stock->load_stock_number);
                  $form->display('', __('admin.form.Crop'))->default($crop_name);
                  $form->display('', __('admin.form.Variety'))->default($crop_variety->crop_variety_name);
                  $form->display('', __('Generation'))->default($seed_class);
                  $form->display('quantity', __('admin.form.Seed Sample size(kgs)'));
                  $form->hidden('crop_variety_id', __('admin.form.Crop Variety'))->default($crop_variety->id);
                  
                 
            }

            $form->text('seed_lab_test_report_number', __('admin.form.Seed lab test report number'))->default('labtest' . "/" . mt_rand(10000000, 99999999))->readonly();
            $form->decimal('seed_sample_size', __('admin.form.Test sample size(g)'))->required();
            $form->multipleSelect('testing_methods', __('admin.form.Testing method'))->options(
                [
                   'Test de germination' => 'Test de germination',
                    'Test de pureté' => 'Test de pureté',
                    'Test de teneur en humidité' => 'Test de teneur en humidité',
                
                ])->required();
                
            $form->decimal('germination_test_results', __('admin.form.Germination test results'))->required();
            $form->decimal('purity_test_results', __('admin.form.Purity test results'))->required();
            $form->decimal('moisture_content_test_results', __('admin.form.Moisture content test results'))->required();
            $form->textarea('additional_tests_results', __('admin.form.Additional tests results'))->required();
            $form->radio('test_decision', __('admin.form.Test decision'))
                ->options(
                    ['marketable' => __('admin.form.Marketable'), 
                    'not marketable' => __('admin.form.Not Marketable')
                    ])
                ->when('marketable', function (Form $form) use ($crop_variety, $crop) {
                    $form->text('lot_number', __('admin.form.Lot number'))->default($crop->crop_code.$crop_variety->crop_variety_code. mt_rand(10000, 999999))->readonly();
                })->required();
            $form->file('reporting_and_signature', __('admin.form.Reporting and signature'))->required();
        }

        //disable edit and delete buttons
        $form->tools(function (Form\Tools $tools) {
            $tools->disableDelete();
            $tools->disableView();
        });

        //disable checkboxes
        $form->footer(function ($footer) {
            $footer->disableViewCheck();
            $footer->disableEditingCheck();
            $footer->disableCreatingCheck();
        });

        return $form;
    }
}