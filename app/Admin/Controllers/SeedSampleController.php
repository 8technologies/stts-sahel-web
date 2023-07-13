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


class SeedSampleController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Seed Sample Request';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new SeedLab());
        $user = Admin::user();
        if (!$user->isRole('commissioner')) {

            if (!$user->isRole('inspector')) {
                $grid->model()->where('applicant_id', auth('admin')->user()->id);
            } else {
                $grid->model()->where('inspector_id', auth('admin')->user()->id);
            }
        }

        if (!$user->inRoles(['basic-user','grower'])){
            $grid->disableCreateButton();
        }


        $grid->column('id', __('Id'));
        $grid->column('sample_request_number', __('Sample request number'));
        $grid->column('applicant_id', __('Applicant '))->display(function($user_id){
            return \App\Models\User::find($user_id)->name;
        });
        $grid->column('load_stock_id', __('Load stock number'));
        $grid->column('sample_request_date', __('Sample request date'));
        $grid->column('status', __('Status'))->display(function ($status) {
            return \App\Models\Utils::tell_status($status) ?? '-';
        });
        $grid->column('applicant_remarks', __('Applicant remarks'));
      
        //disable delete button
        $grid->actions(function ($actions) {
            $actions->disableDelete();
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
        $show = new Show(SeedLab::findOrFail($id));

       
        $show->field('sample_request_number', __('Sample request number'));
        $show->field('applicant_id', __('Applicant id'))->as(function ($applicant_id) {
            return \App\Models\User::find($applicant_id)->name;
        });
        $show->field('load_stock_id', __('Load stock number'));
        $show->field('sample_request_date', __('Sample request date'));
        $show->field('proof_of_payment', __('Proof of payment'))->file();
        $show->field('applicant_remarks', __('Applicant remarks'));
       
       //disable edit button and delete button
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
       
        //forms for user and seed producer
        if(auth('admin')->user()->inRoles(['basic-user', 'grower'])) {
            $form->text('sample_request_number', __('Sample request number'));
            $form->select('load_stock_id', __('Load stock number'))->options($crop_stock->pluck('load_stock_number', 'id'));
            $form->date('sample_request_date', __('Sample request date'))->default(date('Y-m-d'));
            $form->file('proof_of_payment', __('Proof of payment'));
            $form->textarea('applicant_remarks', __('Applicant remarks'));

    
        }
           
        if($form->isEditing()){
           
            $form_id= request()->route()->parameters()['seed_sample_request'];
            $seed_lab = SeedLab::find($form_id);
           
            $crop_declaration = LoadStock::where('id', $seed_lab->load_stock_id)->where('applicant_id', $seed_lab->applicant_id )->value('crop_declaration_id');
            //get crop variety from crop_declaration id
            $crop_variety_id = CropDeclaration::where('id', $crop_declaration)->value('crop_variety_id');
            //get crop variety name from crop_variety id
            $crop_variety= CropVariety::where('id', $crop_variety_id)->first();
            //get crop name from crop variety
            $crop_name = Crop::where('id', $crop_variety->crop_id)->value('crop_name');

            $applicant_name = Administrator::where('id', $seed_lab->applicant_id)->value('name');

     
            if(auth('admin')->user()->inRoles(['inspector','commissioner'])){
                $form->display('', __('Applicant name'))->default($applicant_name);
                $form->display('load_stock_id', __('Load stock number'))->readonly();
                $form->display('', __('Crop'))->default($crop_name);
                $form->display('', __('Variety'))->default($crop_variety->crop_variety_name);
                $form->display('', __('Generation'))->default($crop_variety->crop_variety_generation);
                $form->date('sample_request_date', __('Sample request date'))->default(date('Y-m-d'))->readonly();
                $form->file('proof_of_payment', __('Proof of payment'))->readonly();
                $form->display('applicant_remarks', __('Applicant remarks'))->readonly();
                
 
            }

            if(auth('admin')->user()->isRole('commissioner')){
                $form->select('priority', __('Priority'))->options(['low' => 'Low', 'medium' => 'Medium', 'high' => 'High']);
                    $form->textarea('additional_instructions', __('Additional instructions'));
                    $form->select('status', __('Decision'))->options(['pending' => 'Pending', 'inspection assigned'=> 'Assign Inspector']);
        
                //get the users in the admin_user table whose role is inspector
                    $inspectors = Administrator::whereHas('roles', function ($query) {
                        $query->where('slug', 'inspector');
                    })->get();
                    $form->select('inspector_id', __('admin.form. Assign inspector'))->options($inspectors->pluck('name', 'id'));
                    $form->date('reporting_date', __('Expected reporting date'))->default(date('Y-m-d'));
            }

            if(auth('admin')->user()->isRole('inspector')){
            $form->display('priority', __('Priority'));
            $form->textarea('additional_instructions', __('Additional instructions'));
            $form->select('status', __('Decision'))->options(['halted' => 'Halted', 'rejected'=> 'Rejected', 'lab test assigned'=> 'Assign Lab Test']);
            $form->text('sample_request_number', __('Sample request number'))->readonly();
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
