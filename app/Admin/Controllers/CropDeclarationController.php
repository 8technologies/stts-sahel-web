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

        //show the user only crop declarations belonging to them
        if(!auth('admin')->user()->isRole('commissioner')){
            $grid->model()->where('applicant_id', auth('admin')->user()->id);
        }

        //disable filter
        $grid->disableFilter();

        $grid->model()->orderBy('id', 'desc');
        $grid->quickSearch('applicant_registration_number', 'field_name', 'district_region', 'circle',  'seed_supplier_name', 'seed_supplier_registration_number', 'source_lot_number', 'origin_of_variety',);

       
        $grid->column('applicant_id', __('admin.form.Applicant'))->display(function ($applicant_id) {
            return \App\Models\User::find($applicant_id)->name;
        });
        $grid->column('phone_number', __('admin.form.Phone number'));
        $grid->column('applicant_registration_number', __('admin.form.Applicant registration number'));
        $grid->column('garden_size', __('admin.form.Garden size'));
        $grid->column('field_name', __('admin.form.Field name'));
        $grid->column('planting_date', __('admin.form.Planting date'))->display(function ($planting_date) {
            return date('d-m-Y', strtotime($planting_date));
        });
        $grid->column('status', __('admin.form.Status'))
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
        $crop_declaration = CropDeclaration::findOrFail($id);
        $user = auth()->user();
       
        $show->field('applicant_id', __('admin.form.Applicant Name'))->as(function ($applicant_id) {
            return \App\Models\User::find($applicant_id)->name;
        });
        $show->field('phone_number', __('admin.form.Phone number'));
        $show->field('applicant_registration_number', __('admin.form.Applicant registration number'));
       
        $show->field('garden_size', __('admin.form.Garden size'));
        $show->field('gps_coordinates_1', __('admin.form.Gps coordinates 1'));
        $show->field('gps_coordinates_2', __('admin.form.Gps coordinates 2'));
        $show->field('gps_coordinates_3', __('admin.form.Gps coordinates 3'));
        $show->field('gps_coordinates_4', __('admin.form.Gps coordinates 4'));
        $show->field('field_name', __('admin.form.Field name'));
        $show->field('district_region', __('admin.form.District region'));
        $show->field('circle', __('admin.form.Circle'));
        $show->field('township', __('admin.form.Township'));
        $show->field('village', __('admin.form.Village'));
        $show->field('planting_date', __('admin.form.Planting date'));
        $show->field('quantity_of_seed_planted', __('admin.form.Quantity of seed planted'));
        $show->field('expected_yield', __('admin.form.Expected yield'));
        $show->field('seed_supplier_name', __('admin.form.Seed supplier name'));
        $show->field('seed_supplier_registration_number', __('admin.form.Seed supplier registration number'));
        $show->field('source_lot_number', __('admin.form.Source lot number'));
        $show->field('origin_of_variety', __('admin.form.Origin of variety'));
        $show->field('garden_location_latitude', __('admin.form.Garden location latitude'));
        $show->field('garden_location_longitude', __('admin.form.Garden location longitude'));
        $show->field('status', __('admin.form.Status'));
        $show->field('remarks', __('admin.form.Remarks'))->as(function ($remarks) {
            return $remarks == null ? 'No remarks yet' : $remarks;
        });
        
        //if the user is a commissioner, show the inspector
        if ($user->isRole('commissioner')) {
            //check if inspector_id is not null
            if ($crop_declaration->inspector_id == null) {
                $show->field('inspector_id', __('admin.form.Inspector'))->as(function ($inspector_id) {
                    return 'No inspector assigned yet';
                });
            }else{
                $show->field('inspector_id', __('admin.form.Inspector'))->as(function ($inspector_id) {
                    return \App\Models\User::find($inspector_id)->name;
                });
            }
        
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

        $user = auth()->user();

        if ($user->isRole('grower')) {
            $seed_producer= SeedProducer::where(['user_id' => $user->id, 'status' => 'accepted'])->first();
            if ($seed_producer == null) {
                return admin_warning('No Valid Seed Producer Form Found.', 'You need to have at least one valid Seed Producer.');
            }
            if ($form->isCreating()) {
                $form->hidden('applicant_id')->default($user->id);
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

            $form->hidden('seed_producer_id')->default($seed_producer->id);
        }

        if ($user->inRoles(['basic-user', 'grower'])) 
        {
            $form->select('crop_variety_id', __('admin.form.Crop variety'))
                ->options(CropVariety::all()->pluck('crop_variety_name', 'id'))
                ->required();

            $form->text('phone_number', __('admin.form.Phone number'))->required();
            $form->text('applicant_registration_number', __('admin.form.Applicant registration number'));
            $form->decimal('garden_size', __('admin.form.Garden size'))->required();
            $form->decimal('gps_coordinates_1', __('admin.form.Gps coordinates 1'))->required();
            $form->decimal('gps_coordinates_2', __('admin.form.Gps coordinates 2'))->required();
            $form->decimal('gps_coordinates_3', __('admin.form.Gps coordinates 3'))->required();
            $form->decimal('gps_coordinates_4', __('admin.form.Gps coordinates 4'))->required();
            $form->text('field_name', __('admin.form.Field name'));
            $form->text('district_region', __('admin.form.District region'))->required();
            $form->text('circle', __('admin.form.Circle'))->required();
            $form->text('township', __('admin.form.Township'))->required();
            $form->text('village', __('admin.form.Village'))->required();
            $form->date('planting_date', __('admin.form.Planting date'))->default(date('Y-m-d'))->required();
            $form->number('quantity_of_seed_planted', __('admin.form.Quantity of seed planted'))->required();
            $form->number('expected_yield', __('admin.form.Expected yield'))->required();
            $form->text('seed_supplier_name', __('admin.form.Seed supplier name'))->required();
            $form->text('seed_supplier_registration_number', __('admin.form.Seed supplier registration number'))->required();
            $form->text('source_lot_number', __('admin.form.Source lot number'))->required();
            $form->text('origin_of_variety', __('admin.form.Origin of variety'))->required();
            $form->decimal('garden_location_latitude', __('admin.form.Garden location latitude'));
            $form->decimal('garden_location_longitude', __('admin.form.Garden location longitude'));
            $form->textarea('details', __('admin.form.Provide more details about the garden'));
        }




        if ($user->isRole('commissioner')) {
            $form->display('crop_variety_id', __('admin.form.Crop variety'))
            ->with(function ($crop_variety_id)
            {
                return CropVariety::find($crop_variety_id)->crop_variety_name;
            })
            ->required();

            $form->display('phone_number', __('admin.form.Phone number'));
            $form->display('applicant_registration_number', __('admin.form.Applicant registration number'));
            $form->display('garden_size', __('admin.form.Garden size'));
            $form->display('gps_coordinates_1', __('admin.form.Gps coordinates 1'));
            $form->display('gps_coordinates_2', __('admin.form.Gps coordinates 2'));
            $form->display('gps_coordinates_3', __('admin.form.Gps coordinates 3'));
            $form->display('gps_coordinates_4', __('admin.form.Gps coordinates 4'));
            $form->display('field_name', __('admin.form.Field name'));
            $form->display('district_region', __('admin.form.District region'));
            $form->display('circle', __('admin.form.Circle'));
            $form->display('township', __('admin.form.Township'));
            $form->display('village', __('admin.form.Village'));
            $form->display('planting_date', __('admin.form.Planting date'))->default(date('Y-m-d'));
            $form->display('quantity_of_seed_planted', __('admin.form.Quantity of seed planted'));
            $form->display('expected_yield', __('admin.form.Expected yield'));
            $form->display('seed_supplier_name', __('admin.form.Seed supplier name'));
            $form->display('seed_supplier_registration_number', __('admin.form.Seed supplier registration number'));
            $form->display('source_lot_number', __('admin.form.Source lot number'));
            $form->display('origin_of_variety', __('admin.form.Origin of variety'));
            $form->display('garden_location_latitude', __('admin.form.Garden location latitude'));
            $form->display('garden_location_longitude', __('admin.form.Garden location longitude'));
            $form->textarea('details', __('admin.form.Provide more details about the garden'));

            $form->divider(__('admin.form.Administrator decision'));
            $form->select('status', __('admin.form.Status'))
                ->options([
                    'Inspection assigned' => __('admin.form.Inspection assigned'),
                    'rejected' => __('admin.form.Rejected'),
                    'halted' => __('admin.form.Halted'),
                ])
                ->default('pending');
            $form->textarea('remarks', __('admin.form.Status comment'));



            $users = [];

            foreach (Administrator::all() as $key => $admin) {
                if ($admin->isRole('inspector')) {
                    $users[$admin->id] = $admin->name;
                }
            }

            $form->select('inspector_id', __('admin.form.Inspector'))
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
