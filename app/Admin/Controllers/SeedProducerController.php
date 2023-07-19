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

        //order by pending first
        $grid->model()->orderByRaw('CASE WHEN status = "pending" THEN 1 ELSE 2 END');
        
        $seed_producer = SeedProducer::where('user_id', auth('admin')->user()->id)->value('status');
         if(!$user->isRole('basic-user')){
            //disable create button and delete
            $grid->disableCreateButton();
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
        });
        //diasable filter
        $grid->disableFilter();

        if(!auth('admin')->user()->isRole('commissioner')){
            $grid->model()->where('user_id', auth('admin')->user()->id);
        }
        $grid->model()->orderBy('id', 'desc');
        $grid->column('created_at', __('Date'))->display(function($created_at){
            return date('d-m-Y', strtotime($created_at));
        });
        $grid->column('user_id', __('Applicant'))->display(function($user_id){
            return \App\Models\User::find($user_id)->name;
        });
        $grid->quicksearch('name_of_applicant')->placeholder('Search by name of applicant');
        $grid->column('producer_registration_number', __('Producer registration number'))->display(function($value){
            return $value ?? '-';
        })->sortable();
        $grid->column('producer_category', __('Producer category'))->sortable();
        $grid->column('grower_number', __('Grower number'))->display(function($value){
            return $value ?? '-';
        });
        $grid->column('status', __('Status'))->display(function($status){
            return \App\Models\Utils::tell_status($status);
        })->sortable();
        $grid->column('valid_from', __('Valid from'))->display(function($value){
            return $value ?? '-';
        });
        $grid->column('valid_until', __('Valid until'))->display(function($value){
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

       
        $show->field('user_id', __('Applicant Name'))->as(function($user_id){
            return \App\Models\User::find($user_id)->name;
        });
        $show->field('producer_registration_number', __('Producer registration number'))->as(function($value){
            return $value ?? '-';
        });
        $show->field('producer_category', __('Producer category'));
        $show->field('applicant_phone_number', __('Applicant phone number'));
        $show->field('applicant_email', __('Applicant email'));
        $show->field('premises_location', __('Premises location'));
        $show->field('proposed_farm_location', __('Proposed farm location'));
        $show->field('years_of_experience', __('Years of experience'));
        $show->field('gardening_history_description', __('Gardening history description'));
        $show->field('storage_facilities_description', __('Storage facilities description'));
        $show->field('have_adequate_isolation', __('Have adequate isolation'))->as(function($value){
            if($value == 0){
                return 'No';
            }
            else{
                return 'Yes';
            }
        });
        $show->field('labor_details', __('Labor details'));
        $show->field('receipt', __('Receipt'))->file();
        $show->field('status', __('Status'));
        $show->field('status_comment', __('Status comment'))->as(function($value){
            return $value ?? '-';
        });
        $show->field('grower_number', __('Grower number'))->as(function($value){
            return $value ?? '-';
        });
        $show->field('valid_from', __('Valid from'))->as(function($value){
            return $value ?? '-';
        });
        $show->field('valid_until', __('Valid until'))->as(function($value){
            return $value ?? '-';
        });
        $show->field('created_at', __('Created at'))->as(function($value){
            return $value ?? '-';
        });
        $show->field('updated_at', __('Updated at'))->as(function($value){
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
           
            $form->display('producer_category', __('Producer category'))->options([
                'Seed-breeder' => 'Seed-breeder',
                'Seed-Company' => 'Seed-Company',
            ]);
            $form->display('applicant_phone_number', __('Applicant phone number'));
            $form->display('applicant_email', __('Applicant email'));
            $form->display('premises_location', __('Premises location'));
            $form->display('proposed_farm_location', __('Proposed farm location'));
            $form->display('years_of_experience', __('Years of experience'));
            $form->display('gardening_history_description', __('Gardening history description'));
            $form->display('storage_facilities_description', __('Storage facilities description'));
            $form->radio('have_adequate_isolation', __('Have adequate isolation'))
            ->options([
                '1' => 'Yes',
                '0' => 'No',
            ])->readonly();
            $form->textarea('labor_details', __('Labor details'));
            
        $form->file('receipt', __('Receipt'))->readonly();
        }
        else
        {
           
            $form->select('producer_category', __('Producer category'))->options([
                'Individual-grower' => 'Individual-grower',
                'Seed-breeder' => 'Seed-breeder',
                'Seed-Company' => 'Seed-Company',
            ]);
           
            $form->text('applicant_phone_number', __('Applicant phone number'));
            $form->text('applicant_email', __('Applicant email'));
            $form->text('premises_location', __('Premises location'));
            $form->text('proposed_farm_location', __('Proposed farm location'));
            $form->text('years_of_experience', __('Years of experience'));
            $form->textarea('gardening_history_description', __('Gardening history description'));
            $form->textarea('storage_facilities_description', __('Storage facilities description'));
            $form->radio('have_adequate_isolation', __('Have adequate isolation'))
            ->options([
                '1' => 'Yes',
                '0' => 'No',
            ]);
            $form->textarea('labor_details', __('Labor details'));

            if($form->isEditing()){
                $form->saving(function($form){
                    $form->status = 'pending';
                    return $form;
                });
            }
            
        $form->file('receipt', __('Receipt')); 
        }

        if($user->isRole('commissioner')){
            $form->divider();
            $form->select('status', __('Status'))
            ->options([
                'accepted' => 'Accepted',
                'rejected' => 'Rejected',
                'halted' => 'Halted',
            ])
            ->default('pending');
            $form->textarea('status_comment', __('Status comment')); 
        
            $form->text('producer_registration_number', __('Producer registration number'))->default(rand(1000,100000));
            $form->text('grower_number', __('Grower number'))->default(rand(1000,100000));
            $form->datetime('valid_from', __('Valid from'))->default(date('Y-m-d H:i:s'));
            $form->datetime('valid_until', __('Valid until'))->default(date('Y-m-d H:i:s'));
        }

        //disable delete and view button
        $form->tools(function (Form\Tools $tools) {
            $tools->disableDelete();
            $tools->disableView();

            
        });
        return $form;
    }
}
