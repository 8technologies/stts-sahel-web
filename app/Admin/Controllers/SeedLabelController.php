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
use \App\Models\SeedClass;


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
        if (Admin::user()->isRole('labosem')) {
            $grid->model()->where('status', '=', 'accepted');
        }

        //disable create button and delete button for admin users
        if (!$user->inRoles(['basic-user', 'grower'])) {

            $grid->disableCreateButton();
        }
        //order
        $grid->model()->orderBy('id', 'desc');

        //show a user only what belongs to him if he is not an admin or labosem
        if (!$user->inRoles(['labosem','commissioner'])) {
            $grid->model()->where('user_id', '=', $user->id);
        }

        $grid->column('seed_label_request_number', __('admin.form.Seed label request number'));
        $grid->column('user_id', __('admin.form.Applicant name'))->display(function ($user_id) {
            return Administrator::where('id', $user_id)->value('name');
        });
        $grid->column('label_packages', __('admin.form.Label package'));
        $grid->column('request_date', __('admin.form.Request date'));
        if (!Admin::user()->isRole('labosem')) {
            $grid->column('status', __('Status'))->display(function ($status) {
                return \App\Models\Utils::tell_status($status);
            });
        }
       
        //check if the user is not labosem or admin and disable edit if the status is not pending
        if (!Admin::user()->isRole('labosem')) {
            $grid->actions(function ($actions) {
                if ($actions->row->status != 'pending' && $actions->row->status != null) {
                    $actions->disableEdit();
                    $actions->disableDelete();
                }
                if (Admin::user()->isRole('commissioner')) {
                    $actions->disableDelete();
                }
            });
        }else{
            $grid->actions(function ($actions) {
                $actions->disableDelete();
                $actions->disableEdit();
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
        $show = new Show(SeedLabel::findOrFail($id));

        $seed_label = SeedLabel::find($id);
        //get the users successfully registered seed labs
        $seed_lab = SeedLab::where('id', $seed_label->seed_lab_id)->first();
        $crop_declaration = LoadStock::where('id', $seed_lab->load_stock_id)->where('user_id', $seed_lab->user_id)->value('crop_declaration_id');
        //get crop variety from crop_declaration id
        $crop_variety_id = CropDeclaration::where('id', $crop_declaration)->value('crop_variety_id');
        //get crop variety name from crop_variety id
        $crop_variety = CropVariety::where('id', $crop_variety_id)->first();
        //get crop name from crop variety
        $crop_name = Crop::where('id', $crop_variety->crop_id)->value('crop_name');
        $show->field('seed_label_request_number', __('admin.form.Seed label request number'));
        $show->field('user_id', __('admin.form.Applicant name'))->as(function ($user_id) {
            return Administrator::where('id', $user_id)->value('name');
        });

        $show->field('id', __('admin.form.Crop'))->as(function ($crop) use ($crop_name) {
            return $crop_name;
        });
        $show->field('a', __('admin.form.Variety'))->as(function ($variety) use ($crop_variety) {
            return $crop_variety->crop_variety_name;
        });
        $show->field('', __('admin.form.Generation'))->as(function ($generation) use ($crop_variety) {
            return \App\Models\SeedClass::find($crop_variety->crop_variety_generation)->class_name;
    });
        $show->field('label_packages', __('admin.form.Label package'));
        $show->field('proof_of_payment', __('admin.form.Proof of payment'))->file();
        $show->field('request_date', __('admin.form.Request date'));
        $show->field('applicant_remarks', __('admin.form.Applicant remarks'));

        //show the details in the pivot table
        $show->packages(__('admin.form.Label package'), function ($packages) {
            $packages->resource('/admin/label-packages');
            $packages->package_id(__('admin.form.Label package'))->display(function ($package_id) {
                return LabelPackage::find($package_id)->quantity . 'kgs' . ' @ ' . LabelPackage::find($package_id)->price;
            });

            $packages->quantity(__('admin.form.Quantity'));
            //add a print button with the package id as the id
            if(Admin::user()->isRole('labosem')){
                $packages->column('id', __('admin.form.print'))->display(function ($id) {
                    $link = url('label?id=' . $id);
    
                    return '<a href="' . $link . '" class="btn btn-sm btn-success" target="_blank">Print</a>';
                });
            }
          
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
            $form->hidden('user_id')->default($user->id);
        }
        //get the users successfully registered seed labs
        $seed_lab_id = SeedLab::where('user_id', Auth::user()->id)->where('test_decision', 'marketable')->get();

        if ($user->inRoles(['basic-user', 'grower','agro-dealer','cooperative'])) {

            $form->select('seed_lab_id', __('admin.form.Lot number'))->options($seed_lab_id->pluck('lot_number', 'id'))->required();
            $form->text('seed_label_request_number', __('admin.form.Seed label request number'))->default('SLR' . date('YmdHis') . rand(1000, 9999))->readonly();
            $form->file('proof_of_payment', __('admin.form.Proof of payment'));
            $form->date('request_date', __('admin.form.Request date'))->default(date('Y-m-d'));
            $form->textarea('applicant_remarks', __('admin.form.Applicant remarks'));

            $form->text('label_packages', __('admin.form.Label package Type'));
            $form->hasMany('packages', __('admin.form.Packages'), function (Form\NestedForm $form) {
                //drop down of the price and quantity from the label package table
                $label_package = LabelPackage::all();
                $label_package_array = [];
                foreach ($label_package as $label) {
                    $label_package_array[$label->id] = $label->quantity . 'kgs' . ' @ ' . $label->price;
                }

                $form->select('package_id', __('admin.form.Label package'))->options($label_package_array)->required();
                $form->number('quantity', __('admin.form.Quantity'))->required();
            });
        }

        if ($form->isEditing()) {

            $form_id = request()->route()->parameters()['seed_label'];
            $seed_label = SeedLabel::find($form_id);
            //get the users successfully registered seed labs
            $seed_lab = SeedLab::where('id', $seed_label->seed_lab_id)->first();
            $crop_declaration = LoadStock::where('id', $seed_lab->load_stock_id)->where('user_id', $seed_lab->user_id)->value('crop_declaration_id');
            //get crop variety from crop_declaration id
            $crop_variety_id = CropDeclaration::where('id', $crop_declaration)->value('crop_variety_id');
            //get crop variety name from crop_variety id
            $crop_variety = CropVariety::where('id', $crop_variety_id)->first();
            //get crop name from crop variety
            $crop_name = Crop::where('id', $crop_variety->crop_id)->value('crop_name');

            $applicant_name = Administrator::where('id', $seed_lab->user_id)->value('name');
            $seed_class = SeedClass::where('id',$crop_variety->crop_variety_generation)->value('class_name');
            if ($user->inRoles(['commissioner', 'labosem'])) {

                $form->display('seed_label_request_number', __('admin.form.Seed label request number'));
               
                $form->display('', __('admin.form.Applicant name'))->default($applicant_name);
                $form->display('', __('admin.form.Crop'))->default($crop_name);
                $form->display('', __('admin.form.Variety'))->default($crop_variety->crop_variety_name);
                $form->display('', __('admin.form.Generation'))->default($seed_class);
                $form->display('label_packages', __('admin.form.Label packages'));
                // $form->display('quantity_of_seed', __('Quantity of seed'));
                $form->display('proof_of_payment', __('admin.form.Proof of payment'));
                $form->display('request_date', __('admin.form.Request date'))->default(date('Y-m-d'));
                $form->display('applicant_remarks', __('admin.form.Applicant remarks'));
              
                $form->hasMany('packages', __('admin.form.Packages'), function (Form\NestedForm $form) {
                    //drop down of the price and quantity from the label package table
                    $label_package = LabelPackage::all();
                    $label_package_array = [];
                    foreach ($label_package as $label) {
                        $label_package_array[$label->id] = $label->quantity . 'kgs' . ' @ ' . $label->price;
                    }
                    $form_id = request()->route()->parameters()['seed_label'];
                    $seed_label = SeedLabel::find($form_id);
                    $form->display('package_id', __('admin.form.Label package'));
                    $form->display('quantity', __('admin.form.Quantity'))->readonly();
                })->readonly();
            }
            if ($user->isRole('commissioner')) {
$form->divider('Administrator descision');
                $form->select('status', __('admin.form.Status'))->options(['accepted' => 'Approved', 'rejected' => 'Rejected'])->default('pending');
            }

            if ($user->isRole('labosem')) {
$form->divider('Administrator descision');
                $form->select('status', __('admin.form.Status'))->options(['printed' => 'Printed', 'rejected' => 'Rejected'])->default('pending');
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
