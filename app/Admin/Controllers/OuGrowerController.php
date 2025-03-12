<?php

namespace App\Admin\Controllers;

use App\Models\OutGrower;
use App\Models\SeedProducer;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use App\Models\Utils;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Show;

class OuGrowerController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected function title()
    {
        return trans('admin.form.Out-grower');
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new OutGrower());
        $seed_company = SeedProducer::where('user_id', auth()->user()->id)->first();

        //show only the outgrowers of the authenticated user
        if($seed_company != null ){
            $seed_company_id = $seed_company->id;
            $grid->model()->where('seed_company_id', $seed_company_id );
        }

        $grid->column('seed_company_registration_number', __('admin.form.Seed company registration number'));
        $grid->column('first_name', __('admin.form.First name'));
        $grid->column('last_name', __('admin.form.Last name'));
        $grid->column('phone_number', __('admin.form.Phone number'));
        $grid->column('gender', __('admin.form.Gender'));
        $grid->column('email_address', __('admin.form.Email address'));
    
        //disable the create button if the user is not a seed producer
        if(!Admin::user()->isRole('grower')){
            $grid->disableCreateButton();
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
        $show = new Show(OutGrower::findOrFail($id));

        $show->field('contract_number', __('admin.form.Contract number'));
        $show->field('seed_company_registration_number', __('admin.form.Seed company registration number'));
        $show->field('first_name', __('admin.form.First name'));
        $show->field('last_name', __('admin.form.Last name'));
        $show->field('phone_number', __('admin.form.Phone number'));
        $show->field('gender', __('admin.form.Gender'));
        $show->field('email_address', __('admin.form.Email address'));
        $show->field('cooperative', __('admin.form.Cooperative'));
        $show->field('district', __('admin.form.Region'));
        $show->field('sub_county', __('admin.form.Circle'));
        $show->field('town_street', __('admin.form.physical address'));
        $show->field('community', __('admin.form.Community'));
        $show->field('plot_number', __('admin.form.Plot number'));
        $show->field('valid_from', __('admin.form.Valid from'));
        $show->field('valid_to', __('admin.form.Valid to'));
        
       

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new OutGrower());
        //find the aunthenticated user id
        $user_id = auth()->user()->id;
        //find the seed company id of the authenticated user
        $seed_company= \App\Models\SeedProducer::where('user_id', $user_id)->first();
        
        if ($seed_company == null) {
            return $form->html('<p style="text-align: center; font-size: larger; ">
                <span style="font-size: 2em;">❌</span><br> 
                <span style="font-size: 1.5em; font-weight: bold; line-height: 2.5;">Accès refusé</span><br> 
                Vous n\'avez pas la permission d\'ajouter un producteur délégué.<br>
                Veuillez vérifier vos informations d\'identification et réessayer.<br>
                Code d\'erreur : 403
            </p>');


        }else{
            $form->hidden('seed_company_id')->value($seed_company->id);

        }
       
        
        $form->text('seed_company_registration_number', __('admin.form.Seed company registration number'))->readonly()->value($seed_company->producer_registration_number);
        $form->text('contract_number', __('admin.form.Contract number'))->required();
        $form->text('first_name', __('admin.form.First name'))->required();
        $form->text('last_name', __('admin.form.Last name'))->required();
        $form->text('phone_number', __('admin.form.Phone number'))->required();
        $form->radio('gender', __('admin.form.Gender'))->options([
            'female' => 'Female',
            'male' => 'Male',
            'other' => 'Other',
        ])->required();
        
        $form->text('email_address', __('admin.form.Email address'));
        $form->text('town_street', __('admin.form.physical address'));
        $form->text('cooperative', __('admin.form.Cooperative'));
        $form->text('community', __('admin.form.Community'))->required();
        $form->text('district', __('admin.form.Region'))->required();
        $form->text('sub_county', __('admin.form.Circle'))->required();
        $form->text('plot_number', __('admin.form.Plot number'))->required();
        $form->date('valid_from', __('admin.form.Valid from'))->default(date('Y-m-d'))->required();
        $form->date('valid_to', __('admin.form.Valid to'))->default(date('Y-m-d'))->required();

        //disable check boxes
        $form->disableViewCheck();
        $form->disableEditingCheck();
        $form->disableCreatingCheck();
        
        

        return $form;
    }
}
