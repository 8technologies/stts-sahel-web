<?php

namespace App\Admin\Controllers;

use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Facades\Admin;

use \App\Models\AgroDealers;

class AgroDealersController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'AgroDealers';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new AgroDealers());
        $user = Admin::user();
        $agro_dealer = AgroDealers::where('applicant_id', auth('admin')->user()->id)->value('status');
        if (!$user->inRoles(['basic-user', 'grower'])) {
            //disable create button and delete
            $grid->disableCreateButton();
        }
        $grid->actions(function ($actions) {
            $actions->disableDelete();
        });
        $grid->column('id', __('Id'));
        $grid->column('agro_dealer_reg_number', __('Agro dealer reg number'));
        $grid->column('first_name', __('First name'));
        $grid->column('last_name', __('Last name'));
        $grid->column('email', __('Email'));
        $grid->column('physical_address', __('Physical address'));
        $grid->column('status', __('Status'))->display(function ($status) {
            return \App\Models\Utils::tell_status($status);
        })->sortable();
        if ($agro_dealer == 'accepted') {
            $grid->column('id', __('admin.form.Certificate'))->display(function ($id) {
                $link = url('agro_certificate?id=' . $id);
                return '<b><a target="_blank" href="' . $link . '">Print Certificate</a></b>';
            });
        }

        //check the status field of the form

        if ($agro_dealer == 'accepted') {
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
        $show = new Show(AgroDealers::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('agro_dealer_reg_number', __('Agro dealer reg number'));
        $show->field('first_name', __('First name'));
        $show->field('last_name', __('Last name'));
        $show->field('email', __('Email'));
        $show->field('physical_address', __('Physical address'));
        $show->field('district', __('District'));
        $show->field('circle', __('Circle'));
        $show->field('township', __('Township'));
        $show->field('town_plot_number', __('Town plot number'));
        $show->field('shop_number', __('Shop number'));
        $show->field('company_name', __('Company name'));
        $show->field('retailers_in', __('Retailers in'));
        $show->field('business_registration_number', __('Business registration number'));
        $show->field('years_in_operation', __('Years in operation'));
        $show->field('business_description', __('Business description'));
        $show->field('trading_license_number', __('Trading license number'));
        $show->field('trading_license_period', __('Trading license period'));
        $show->field('insuring_authority', __('Insuring authority'));
        $show->field('attachments_certificate', __('Attachments certificate'));
        $show->field('proof_of_payment', __('Proof of payment'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        //disable the edit and delete action buttons
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
        $form = new Form(new AgroDealers());
        $user = Admin::user();

        if ($form->isCreating()) {
            $form->hidden('applicant_id')->default($user->id);
        }

        if ($user->isRole('basic-user')) {
            $form->text('agro_dealer_reg_number', __('Agro dealer reg number'));
            $form->text('first_name', __('First name'));
            $form->text('last_name', __('Last name'));
            $form->email('email', __('Email'));
            $form->text('physical_address', __('Physical address'));
            $form->text('district', __('District'));
            $form->text('circle', __('Circle'));
            $form->text('township', __('Township'));
            $form->text('town_plot_number', __('Town plot number'));
            $form->text('shop_number', __('Shop number'));
            $form->text('company_name', __('Company name'));
            $form->text('retailers_in', __('Retailers in'));
            $form->text('business_registration_number', __('Business registration number'));
            $form->number('years_in_operation', __('Years in operation'));
            $form->textarea('business_description', __('Business description'));
            $form->text('trading_license_number', __('Trading license number'));
            $form->text('trading_license_period', __('Trading license period'));
            $form->text('insuring_authority', __('Insuring authority'));
            $form->text('attachments_certificate', __('Attachments certificate'));
            $form->text('proof_of_payment', __('Proof of payment'));
        }
        if ($user->inRoles(['commissioner', 'inspector'])) {

            $form->display('first_name', __('First name'));
            $form->display('last_name', __('Last name'));
            $form->display('email', __('Email'));
            $form->display('physical_address', __('Physical address'));
            $form->display('district', __('District'));
            $form->display('circle', __('Circle'));
            $form->display('township', __('Township'));
            $form->display('town_plot_number', __('Town plot number'));
            $form->display('shop_number', __('Shop number'));
            $form->display('company_name', __('Company name'));
            $form->display('retailers_in', __('Retailers in'));
            $form->display('business_registration_number', __('Business registration number'));
            $form->display('years_in_operation', __('Years in operation'));
            $form->display('business_description', __('Business description'));
            $form->display('trading_license_number', __('Trading license number'));
            $form->display('trading_license_period', __('Trading license period'));
            $form->display('insuring_authority', __('Insuring authority'));
            $form->display('attachments_certificate', __('Attachments certificate'));
            $form->display('proof_of_payment', __('Proof of payment'));
            //admin decision
            if ($user->isRole('commissioner')) {
                $form->divider('Administartor decision');
                $form->radioButton('status', __('admin.form.Status'))
                    ->options([
                        'accepted' => 'Accepted',
                        'rejected' => 'Rejected',
                        'halted' => 'Halted',
                        'inspector assigned' => 'Assign Inspector',

                    ])
                    ->when('in', ['rejected', 'halted'], function (Form $form) {
                        $form->textarea('status_comment', __('admin.form.Status comment'));
                    })
                    ->when('accepted', function (Form $form) {
                        $form->text('agro_dealer_reg_number', __('Agro dealer reg number'))->default(rand(1000, 100000));
                        $form->datetime('valid_from', __('admin.form.Seed producer approval date'))->default(date('Y-m-d H:i:s'))->required();
                        $form->datetime('valid_until', __('admin.form.Valid until'))->default(date('Y-m-d H:i:s'))->required();
                    })
                    ->when('inspector assigned', function (Form $form) {

                        //get all inspectors
                        $inspectors = \App\Models\Utils::get_inspectors();
                        $form->select('inspector_id', __('admin.form.Inspector'))
                            ->options($inspectors);
                    })->required();
            }
            //inspectors decision
            if ($user->isRole('inspector')) {
                $form->divider('Inspectors decision');
                $form->radioButton('status', __('admin.form.Status'))
                    ->options([
                        'accepted' => 'Accepted',
                        'rejected' => 'Rejected',
                        'halted' => 'Halted',
                    ])
                    ->when('in', ['rejected', 'halted'], function (Form $form) {
                        $form->textarea('status_comment', __('admin.form.Status comment'));
                    })

                    ->when('accepted', function (Form $form) {
                        $form->text('producer_registration_number', __('admin.form.Seed producer registration number'))->default(rand(1000, 100000))->required();
                        $form->text('grower_number', __('admin.form.Seed producer approval number'))->default(rand(1000, 100000))->required();
                        $form->datetime('valid_from', __('admin.form.Seed producer approval date'))->default(date('Y-m-d H:i:s'))->required();
                        $form->datetime('valid_until', __('admin.form.Valid until'))->default(date('Y-m-d H:i:s'))->required();
                    })->required();
            }
        }
        //disable the edit and delete action buttons
        $form->tools(function (Form\Tools $tools) {
            $tools->disableDelete();
            $tools->disableView();
        });
        return $form;
    }
}
