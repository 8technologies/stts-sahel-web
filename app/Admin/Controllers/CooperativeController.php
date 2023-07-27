<?php

namespace App\Admin\Controllers;

use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Facades\Admin;
use \App\Models\Cooperative;

class CooperativeController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Cooperative';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Cooperative());
        $user = Admin::user();

        if (!$user->isRole('basic-user')) {
            //disable create button and delete
            $grid->disableCreateButton();
            $grid->actions(function ($actions) {
                $actions->disableDelete();
            });
        }
        // show inspector what has been assigned to him
        if (auth('admin')->user()->isRole('inspector')) {
            $grid->model()->where('inspector_id', auth('admin')->user()->id);
        }

        //show the user only his records
        if (auth('admin')->user()->isRole('basic-user')) {
            $grid->model()->where('user_id', auth('admin')->user()->id);
        }


        $grid->column('id', __('Id'));
        $grid->column('cooperative_number', __('Cooperative number'));
        $grid->column('cooperative_name', __('Cooperative name'));
        $grid->column('registration_number', __('Registration number'))->display(function ($value) {
            return $value ?? '-';
        })->sortable();
        $grid->column('membership_type', __('Membership type'));
        $grid->column('status', __('Status'))->display(function ($status) {
            return \App\Models\Utils::tell_status($status);
        })->sortable();


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
        $show = new Show(Cooperative::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('cooperative_number', __('Cooperative number'));
        $show->field('cooperative_name', __('Cooperative name'));
        $show->field('registration_number', __('Registration number'))->as(function ($value) {
            return $value ?? '-';
        });
        $show->field('cooperative_physical_address', __('Cooperative physical address'));
        $show->field('contact_person_name', __('Contact person name'));
        $show->field('contact_phone_number', __('Contact phone number'));
        $show->field('contact_email', __('Contact email'));
        $show->field('membership_type', __('Membership type'));
        $show->field('services_to_members', __('Services to members'));
        $show->field('objectives_or_goals', __('Objectives or goals'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        //disable edit and delete button
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
        $form = new Form(new Cooperative());

        $user = auth()->user();

        if ($form->isCreating()) {
            $form->hidden('user_id')->default($user->id);
        }
        if ($user->inRoles(['commissioner', 'inspector'])) {
            $form->display('cooperative_number', __('Cooperative number'));
            $form->display('cooperative_name', __('Cooperative name'));
            $form->display('cooperative_physical_address', __('Cooperative physical address'));
            $form->display('contact_person_name', __('Contact person name'));
            $form->display('contact_phone_number', __('Contact phone number'));
            $form->display('contact_email', __('Contact email'));
            $form->display('membership_type', __('Membership type'));
            $form->display('services_to_members', __('Services to members'));
            $form->display('objectives_or_goals', __('Objectives or goals'));
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
                        $form->text('registration_number', __('Registration number'))->default(rand(1000, 100000))->required();
                    })
                    ->when('inspector assigned', function (Form $form) {

                        //get all inspectors
                        $inspectors = \App\Models\Utils::get_inspectors();
                        $form->select('inspector_id', __('admin.form.Inspector'))
                            ->options($inspectors);
                    })->required();
            }
            //inspector decision
            if ($user->isRole('inspector')) {
                $form->divider('Inspector decision');
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
                        $form->text('registration_number', __('Registration number'))->default(rand(1000, 100000))->required();
                    })->required();
            }
        } else {
            $form->text('cooperative_number', __('Cooperative number'));
            $form->text('cooperative_name', __('Cooperative name'));
            $form->text('cooperative_physical_address', __('Cooperative physical address'));
            $form->text('contact_person_name', __('Contact person name'));
            $form->text('contact_phone_number', __('Contact phone number'));
            $form->text('contact_email', __('Contact email'));
            $form->text('membership_type', __('Membership type'));
            $form->text('services_to_members', __('Services to members'));
            $form->text('objectives_or_goals', __('Objectives or goals'));
        }
        //disable delete button
        $form->tools(function (Form\Tools $tools) {
            $tools->disableView();
            $tools->disableDelete();
        });

        return $form;
    }
}
