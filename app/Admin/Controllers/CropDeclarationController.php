<?php

namespace App\Admin\Controllers;

use App\Models\Crop;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use \App\Models\CropDeclaration;
use App\Models\CropVariety;
use App\Models\SeedProducer;
use App\Models\Utils;
use Encore\Admin\Auth\Database\Administrator;

class CropDeclarationController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Crop Declaration Forms';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new CropDeclaration());
       
        $user = auth()->user();
        if ($user->isRole('grower')) {
            $seed_producer = SeedProducer::where(['user_id' => $user->id, 'status' => 'accepted'])->first();
            if ($seed_producer == null) {
                $grid->disableCreateButton();
                return admin_warning('No Valid Seed Producer Form Found.', 'You need to have at least one valid Seed Producer.');
            }
        } else {
            $grid->disableCreateButton();
           
        }
        //disable delete action
        $grid->actions(function ($actions) {
            $actions->disableDelete();
        });
        $grid->column('id', __('Id'));
        $grid->column('applicant_id', __('Applicant'))->display(function ($applicant_id) {
            return \App\Models\User::find($applicant_id)->name;
        });
        $grid->column('phone_number', __('Phone number'));
        $grid->column('applicant_registration_number', __('Applicant registration number'));
        $grid->column('garden_size', __('Garden size'));
        $grid->column('field_name', __('Field name'));
        $grid->column('planting_date', __('Planting date'))->display(function ($planting_date) {
            return date('d-m-Y', strtotime($planting_date));
        });
        $grid->column('status', __('Status'))
        ->display(function ($status) {
            return Utils::tell_status($status);
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
        $show = new Show(CropDeclaration::findOrFail($id));
        $user = auth()->user();
       
        $show->field('applicant_id', __('Applicant Name'))->as(function ($applicant_id) {
            return \App\Models\User::find($applicant_id)->name;
        });
        $show->field('phone_number', __('Phone number'));
        $show->field('applicant_registration_number', __('Applicant registration number'));
       
        $show->field('garden_size', __('Garden size'));
        $show->field('gps_coordinates_1', __('Gps coordinates 1'));
        $show->field('gps_coordinates_2', __('Gps coordinates 2'));
        $show->field('gps_coordinates_3', __('Gps coordinates 3'));
        $show->field('gps_coordinates_4', __('Gps coordinates 4'));
        $show->field('field_name', __('Field name'));
        $show->field('district_region', __('District region'));
        $show->field('circle', __('Circle'));
        $show->field('township', __('Township'));
        $show->field('village', __('Village'));
        $show->field('planting_date', __('Planting date'));
        $show->field('quantity_of_seed_planted', __('Quantity of seed planted'));
        $show->field('expected_yield', __('Expected yield'));
        $show->field('seed_supplier_name', __('Seed supplier name'));
        $show->field('seed_supplier_registration_number', __('Seed supplier registration number'));
        $show->field('source_lot_number', __('Source lot number'));
        $show->field('origin_of_variety', __('Origin of variety'));
        $show->field('garden_location_latitude', __('Garden location latitude'));
        $show->field('garden_location_longitude', __('Garden location longitude'));
        $show->field('status', __('Status'));
        $show->field('remarks', __('Remarks'))->as(function ($remarks) {
            return $remarks == null ? 'No remarks yet' : $remarks;
        });
        
        //if the user is a commissioner, show the inspector
        if ($user->isRole('commissioner')) {
            $show->field('inspector_id', __('Inspector'))->as(function ($inspector_id) {
                return \App\Models\User::find($inspector_id)->name;
            });
        }

        //disable delete and edit button
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
        // $m = CropDeclaration::find(9);
        // $m->remarks .= 'test';
        // $m->save();
        // die("romina");
        $form = new Form(new CropDeclaration());

        $u = auth()->user();

        if ($u->isRole('grower')) {
            $cd = SeedProducer::where(['user_id' => $u->id, 'status' => 'accepted'])->first();
            if ($cd == null) {
                return admin_warning('No Valid Seed Producer Form Found.', 'You need to have at least one valid Seed Producer.');
            }
            if ($form->isCreating()) {
                $form->hidden('applicant_id')->default($u->id);
            }

            //when is saving, check that the expected yield is not more than the quantity of seed planted
            $form->saving(function (Form $form) {
                $quantity_of_seed_planted = $form->quantity_of_seed_planted;
                $expected_yield = $form->expected_yield;
                if ($expected_yield > $quantity_of_seed_planted) {
                    admin_error('Expected yield cannot be more than the quantity of seed planted', 'Please check the values and try again.');
                    return back();
                }
            });

            $form->hidden('seed_producer_id')->default($cd->id);
        }

        if ($u->inRoles(['basic-user', 'grower'])) 
        {
            $form->select('crop_variety_id', __('Crop variety'))
                ->options(CropVariety::all()->pluck('crop_variety_name', 'id'))
                ->required();

            $form->text('phone_number', __('Phone number'));
            $form->text('applicant_registration_number', __('Applicant registration number'));
            $form->decimal('garden_size', __('Garden size'));
            $form->decimal('gps_coordinates_1', __('Gps coordinates 1'));
            $form->decimal('gps_coordinates_2', __('Gps coordinates 2'));
            $form->decimal('gps_coordinates_3', __('Gps coordinates 3'));
            $form->decimal('gps_coordinates_4', __('Gps coordinates 4'));
            $form->text('field_name', __('Field name'));
            $form->text('district_region', __('District region'));
            $form->text('circle', __('Circle'));
            $form->text('township', __('Township'));
            $form->text('village', __('Village'));
            $form->date('planting_date', __('Planting date'))->default(date('Y-m-d'));
            $form->number('quantity_of_seed_planted', __('Quantity of seed planted'));
            $form->number('expected_yield', __('Expected yield'));
            $form->text('seed_supplier_name', __('Seed supplier name'));
            $form->text('seed_supplier_registration_number', __('Seed supplier registration number'));
            $form->text('source_lot_number', __('Source lot number'));
            $form->text('origin_of_variety', __('Origin of variety'));
            $form->decimal('garden_location_latitude', __('Garden location latitude'));
            $form->decimal('garden_location_longitude', __('Garden location longitude'));
        }




        if ($u->isRole('commissioner')) {
            $form->display('crop_variety_id', __('Crop variety'))
            ->with(function ($crop_variety_id)
            {
                return CropVariety::find($crop_variety_id)->crop_variety_name;
            })
            ->required();

            $form->display('phone_number', __('Phone number'));
            $form->display('applicant_registration_number', __('Applicant registration number'));
            $form->display('garden_size', __('Garden size'));
            $form->display('gps_coordinates_1', __('Gps coordinates 1'));
            $form->display('gps_coordinates_2', __('Gps coordinates 2'));
            $form->display('gps_coordinates_3', __('Gps coordinates 3'));
            $form->display('gps_coordinates_4', __('Gps coordinates 4'));
            $form->display('field_name', __('Field name'));
            $form->display('district_region', __('District region'));
            $form->display('circle', __('Circle'));
            $form->display('township', __('Township'));
            $form->display('village', __('Village'));
            $form->display('planting_date', __('Planting date'))->default(date('Y-m-d'));
            $form->display('quantity_of_seed_planted', __('Quantity of seed planted'));
            $form->display('expected_yield', __('Expected yield'));
            $form->display('seed_supplier_name', __('Seed supplier name'));
            $form->display('seed_supplier_registration_number', __('Seed supplier registration number'));
            $form->display('source_lot_number', __('Source lot number'));
            $form->display('origin_of_variety', __('Origin of variety'));
            $form->display('garden_location_latitude', __('Garden location latitude'));
            $form->display('garden_location_longitude', __('Garden location longitude'));
            $form->divider();
            $form->select('status', __('Status'))
                ->options([
                    'Inspection assigned' => 'Inspection assigned',
                    'rejected' => 'Rejected',
                    'halted' => 'Halted',
                ])
                ->default('pending');
            $form->textarea('remarks', __('Status comment'));



            $users = [];

            foreach (Administrator::all() as $key => $admin) {
                if ($admin->isRole('inspector')) {
                    $users[$admin->id] = $admin->name;
                }
            }

            $form->select('inspector_id', __('Inspector'))
                ->options($users);
                
        }

        //disable delete and view button
        $form->tools(function (Form\Tools $tools) {
            $tools->disableDelete();
            $tools->disableView();
        });
        return $form;
    }
}
