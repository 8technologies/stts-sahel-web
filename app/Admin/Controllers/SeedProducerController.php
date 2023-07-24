<?php

namespace App\Admin\Controllers;

use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use \App\Models\SeedProducer;
use Encore\Admin\Facades\Admin;

class SeedProducerController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Seed Producer';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new SeedProducer());
        $user = Admin::user();
        
        $seed_producer = SeedProducer::where('user_id', auth('admin')->user()->id)->value('status');
         if(!$user->isRole('basic-user'))
        {
            //disable create button and delete
            $grid->disableCreateButton();
            $grid->actions (function ($actions) {
                $actions->disableEdit();
            });
    
        }
     
        if($user->isRole('basic-user')){
            if($seed_producer != null){
                if($seed_producer != 'rejected' ){
                    //disable create button and delete
                    $grid->disableCreateButton();
                }
        }
        }

        $grid->actions (function ($actions) {
            $actions->disableDelete();
            $actions->disableView();
        });

        //diasable filter
        $grid->disableFilter();

        if(!auth('admin')->user()->isRole('commissioner')){
            $grid->model()->where('user_id', auth('admin')->user()->id);
        }
        $grid->model()->orderBy('id', 'desc');
        $grid->column('created_at', __('admin.form.Date'))->display(function($created_at){
            return date('d-m-Y', strtotime($created_at));
        });
        $grid->column('user_id', __('admin.form.Applicant'))->display(function($user_id){
            return \App\Models\User::find($user_id)->name;
        });
        $grid->quicksearch('user_id', 'producer_registration_number', 'producer_category', 'grower_number', 'status', 'valid_from', 'valid_until');
        $grid->column('producer_registration_number', __('admin.form.Seed producer registration number'))->display(function($value){
            return $value ?? '-';
        })->sortable();
        $grid->column('producer_category', __('admin.form.Seed producer category'))->sortable();
        $grid->column('grower_number', __('admin.form.Seed producer approval number'))->display(function($value){
            return $value ?? '-';
        });
        $grid->column('status', __('admin.form.Status'))->display(function($status){
            return \App\Models\Utils::tell_status($status);
        })->sortable();
        $grid->column('valid_from', __('admin.form.Seed producer approval date'))->display(function($value){
            return $value ?? '-';
        });
        $grid->column('valid_until', __('admin.form.Valid until'))->display(function($value){
            return $value ?? '-';
        });

        //check the status field of the form
       
        if($seed_producer == 'accepted' ){
            $grid->column('id', __('admin.form.Certificate'))->display(function ($id) {
                $link = url('certificate?id=' . $id);
                return '<b><a target="_blank" href="' . $link . '">Print Certificate</a></b>';
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
        $show = new Show(SeedProducer::findOrFail($id));

       
        $show->field('user_id', __('admin.form.Applicant Name'))->as(function($user_id){
            return \App\Models\User::find($user_id)->name;
        });
        $show->field('producer_registration_number', __('admin.form.Seed producer registration number'))->as(function($value){
            return $value ?? '-';
        });
        $show->field('producer_category', __('admin.form.Producer category'));
        $show->field('applicant_phone_number', __('admin.form.Applicant phone number'));
        $show->field('applicant_email', __('admin.form.Applicant email'));
        $show->field('premises_location', __('admin.form.Applicant physical address'));
        $show->field('proposed_farm_location', __('admin.form.Proposed farm location'));
        $show->field('years_of_experience', __('admin.form.If seed company, years of experience as a seed producer'));
        $show->field('gardening_history_description', __('admin.form.Garden history of the proposed seed production field for the last three season or years'));
        $show->field('storage_facilities_description', __('admin.form.Describe your storage facilities to handle the resultant seed'));
        $show->field('have_adequate_isolation', __('admin.form.Do you have adequate isolation?'))->as(function($value){
            if($value == 0){
                return 'No';
            }
            else{
                return 'Yes';
            }
        });
        $show->field('labor_details', __('admin.form.Detail the labor you have at the farm in terms of numbers and competencies'));
        $show->field('receipt', __('admin.form.Proof of payment of application fees'))->file();
        $show->field('status', __('admin.form.Status'));
        $show->field('status_comment', __('admin.form.Status comment'))->as(function($value){
            return $value ?? '-';
        });
        $show->field('grower_number', __('admin.form.Seed producer approval number'))->as(function($value){
            return $value ?? '-';
        });
        $show->field('valid_from', __('admin.form.Seed producer approval date'))->as(function($value){
            return $value ?? '-';
        });
        $show->field('valid_until', __('admin.form.Valid until'))->as(function($value){
            return $value ?? '-';
        });
     

        //disable delete button
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
        $form = new Form(new SeedProducer()); 

        $user = auth()->user();
        if($form->isCreating()) {
            $form->hidden('user_id')->default($user->id);
        }

        //redirect to the list after saving
        $form->saved(function (Form $form) {
            return redirect(admin_url('seed-producers'));
        });

        if($user->isRole('commissioner'))
        {
           
            $form->display('producer_category', __('admin.form.Seed producer category'))->options([
                'Seed-breeder' => 'Seed-breeder',
                'Seed-Company' => 'Seed-Company',
            ]);
            $form->display('applicant_phone_number', __('admin.form.Applicant phone number'));
            $form->display('applicant_email', __('admin.form.Applicant email'));
            $form->display('premises_location', __('admin.form.Applicant physical address'));
            $form->display('proposed_farm_location', __('admin.form.Proposed farm location'));
            $form->display('years_of_experience', __('admin.form.If seed company, years of experience as a seed producer'));
            $form->display('gardening_history_description', __('admin.form.Garden history of the proposed seed production field for the last three season or years'));
            $form->display('storage_facilities_description', __('admin.form.Describe your storage facilities to handle the resultant seed'));
            $form->radio('have_adequate_isolation', __('admin.form.Do you have adequate isolation?n'))
            ->options([
                '1' => 'Yes',
                '0' => 'No',
            ])->readonly();
            $form->textarea('labor_details', __('admin.form.Detail the labor you have at the farm in terms of numbers and competencies'));
            
            $form->file('receipt', __('admin.form.Proof of payment of application fees'))->readonly();

            $form->divider('Administartor decision');
            $form->select('status', __('admin.form.Status'))
            ->options([
                'accepted' => 'Accepted',
                'rejected' => 'Rejected',
                'halted' => 'Halted',
            ])
            ->default('pending')->required();
            $form->textarea('status_comment', __('admin.form.Status comment')); 
        
            $form->text('producer_registration_number', __('admin.form.Seed producer registration number'))->default(rand(1000,100000))->required();
            $form->text('grower_number', __('admin.form.Seed producer approval number'))->default(rand(1000,100000))->required();
            $form->datetime('valid_from', __('admin.form.Seed producer approval date'))->default(date('Y-m-d H:i:s'))->required();
            $form->datetime('valid_until', __('admin.form.Valid until'))->default(date('Y-m-d H:i:s'))->required();
        }
        else
        {
           
            $form->select('producer_category', __('admin.form.Seed producer category'))->options([
                'Individual-grower' => 'Individual-grower',
                'Seed-breeder' => 'Seed-breeder',
                'Seed-Company' => 'Seed-Company',
            ])->required();
           
            $form->text('applicant_phone_number', __('admin.form.Applicant phone number'))->required();
            $form->text('applicant_email', __('admin.form.Applicant email'))->required();
            $form->text('premises_location', __('admin.form.Applicant physical address'))->required();
            $form->text('proposed_farm_location', __('admin.form.Proposed farm location'))->required();
            $form->text('years_of_experience', __('admin.form.If seed company, years of experience as a seed producer'))->required();
            $form->textarea('gardening_history_description', __('admin.form.Garden history of the proposed seed production field for the last three season or years'))->required();
            $form->textarea('storage_facilities_description', __('admin.form.Describe your storage facilities to handle the resultant seed'))->required();
            $form->radio('have_adequate_isolation', __('admin.form.Do you have adequate isolation?'))
            ->options([
                '1' => 'Yes',
                '0' => 'No',
            ])->required();
            $form->textarea('labor_details', __('admin.form.Detail the labor you have at the farm in terms of numbers and competencies'))->required();

            if($form->isEditing()){
                $form->saving(function($form){
                    $form->status = 'pending';
                    return $form;
                });
            }
            
            $form->file('receipt', __('admin.form.Proof of payment of application fees'))->required(); 
        }

        //disable delete and view button
        $form->tools(function (Form\Tools $tools) {
            $tools->disableDelete();
            $tools->disableView();

            
        });
        return $form;
    }
}
