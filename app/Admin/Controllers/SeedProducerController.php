<?php

namespace App\Admin\Controllers;

use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use \App\Models\SeedProducer;

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

        $sp = SeedProducer::where('user_id', auth('admin')->user()->id)->first();
        if($sp!=null){
            $grid->disableCreateButton();
        }

        if(!auth('admin')->user()->isRole('commissioner')){
            $grid->model()->where('user_id', auth('admin')->user()->id);
        }
        $grid->model()->orderBy('id', 'desc');
        $grid->column('created_at', __('Date'))->display(function($created_at){
            return date('d-m-Y', strtotime($created_at));
        });
        $grid->column('user_id', __('User'))->display(function($user_id){
            return \App\Models\User::find($user_id)->name;
        });
        $grid->quicksearch('name_of_applicant')->placeholder('Search by name of applicant');
        $grid->column('producer_registration_number', __('Producer registration number'));
        $grid->column('producer_category', __('Producer category'))->sortable();
        $grid->column('name_of_applicant', __('Name of applicant'))->sortable();
        $grid->column('applicant_phone_number', __('Applicant phone number'));
        $grid->column('applicant_email', __('Applicant email'))->hide();
        $grid->column('premises_location', __('Premises location'))->hide();
        $grid->column('proposed_farm_location', __('Proposed farm location'))->hide();
        $grid->column('years_of_experience', __('Years of experience'))->hide();
        $grid->column('gardening_history_description', __('Gardening history description'))->hide();
        $grid->column('storage_facilities_description', __('Storage facilities description'))->hide();
        $grid->column('have_adequate_isolation', __('Have adequate isolation'))->hide();
        $grid->column('labor_details', __('Labor details'))->hide();
        $grid->column('receipt', __('Receipt'))->hide();
        $grid->column('grower_number', __('Grower number'));
        $grid->column('status', __('Status'))->label([
            'accepted' => 'success',
            'pending' => 'warning',
            'approved' => 'success',
            'rejected' => 'danger',
            'halted' => 'danger'
        ])->sortable();
        $grid->column('valid_from', __('Valid from'));
        $grid->column('valid_until', __('Valid until'));
        $grid->column('status_comment', __('Status comment'));
     
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

        $show->field('id', __('Id'));
        $show->field('user_id', __('User id'));
        $show->field('producer_registration_number', __('Producer registration number'));
        $show->field('producer_category', __('Producer category'));
        $show->field('name_of_applicant', __('Name of applicant'));
        $show->field('applicant_phone_number', __('Applicant phone number'));
        $show->field('applicant_email', __('Applicant email'));
        $show->field('premises_location', __('Premises location'));
        $show->field('proposed_farm_location', __('Proposed farm location'));
        $show->field('years_of_experience', __('Years of experience'));
        $show->field('gardening_history_description', __('Gardening history description'));
        $show->field('storage_facilities_description', __('Storage facilities description'));
        $show->field('have_adequate_isolation', __('Have adequate isolation'));
        $show->field('labor_details', __('Labor details'));
        $show->field('receipt', __('Receipt'));
        $show->field('status', __('Status'));
        $show->field('status_comment', __('Status comment'));
        $show->field('inspector_id', __('Inspector id'));
        $show->field('grower_number', __('Grower number'));
        $show->field('valid_from', __('Valid from'));
        $show->field('valid_until', __('Valid until'));
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
        $form = new Form(new SeedProducer()); 

        $u = auth()->user();
        if($form->isCreating()) {
            $form->hidden('user_id')->default($u->id);
        }

        if($u->isRole('commissioner')){
            $form->display('producer_registration_number', __('Producer registration number'));
            $form->display('producer_category', __('Producer category'))->options([
                'Individual-grower' => 'Individual-grower',
                'Seed-breeder' => 'Seed-breeder',
                'Seed-Company' => 'Seed-Company',
            ]);
            $form->display('name_of_applicant', __('Name of applicant'));
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
        }else{
            $form->text('producer_registration_number', __('Producer registration number'));
            $form->select('producer_category', __('Producer category'))->options([
                'Individual-grower' => 'Individual-grower',
                'Seed-breeder' => 'Seed-breeder',
                'Seed-Company' => 'Seed-Company',
            ]);
            $form->text('name_of_applicant', __('Name of applicant'));
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

        if($u->isRole('commissioner')){
            $form->divider();
            $form->select('status', __('Status'))
            ->options([
                'accepted' => 'Accepted',
                'pending' => 'Pending',
                'rejected' => 'Rejected',
                'halted' => 'Halted',
            ])
            ->default('pending');
            $form->textarea('status_comment', __('Status comment')); 
            $form->text('grower_number', __('Grower number'))->default(rand(1000,100000));
            $form->datetime('valid_from', __('Valid from'))->default(date('Y-m-d H:i:s'));
            $form->datetime('valid_until', __('Valid until'))->default(date('Y-m-d H:i:s'));
        }


        return $form;
    }
}
