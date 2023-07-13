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
       
        $u = auth()->user();
        if ($u->isRole('grower')) {
            $cd = SeedProducer::where(['user_id' => $u->id, 'status' => 'accepted'])->first();
            if ($cd == null) {
                $grid->disableCreateButton();
                return admin_warning('No Valid Seed Producer Form Found.', 'You need to have at least one valid Seed Producer.');
            }
        } else {
            $grid->disableCreateButton();
        }

        $grid->column('id', __('Id'));
        $grid->column('applicant_id', __('Applicant id'));
        $grid->column('phone_number', __('Phone number'));
        $grid->column('applicant_registration_number', __('Applicant registration number'));
        $grid->column('seed_producer_id', __('Seed producer id'));
        $grid->column('garden_size', __('Garden size'));
        $grid->column('field_name', __('Field name'));
        $grid->column('planting_date', __('Planting date'))->display(function ($planting_date) {
            return date('d-m-Y', strtotime($planting_date));
        });
        $grid->column('status', __('Status'))
        ->display(function ($status) {
            return Utils::tell_status($status);
        })->sortable();
        $grid->column('inspector_id', __('Inspector id'));
        $grid->column('remarks', __('Remarks'));

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

        $show->field('id', __('Id'));
        $show->field('applicant_id', __('Applicant id'));
        $show->field('phone_number', __('Phone number'));
        $show->field('applicant_registration_number', __('Applicant registration number'));
        $show->field('seed_producer_id', __('Seed producer id'));
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
        $show->field('inspector_id', __('Inspector id'));
        $show->field('remarks', __('Remarks'));
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

            $form->hidden('seed_producer_id')->default($cd->id);
        }


        $form->select('crop_variety_id', __('Crop variety'))
            ->options(CropVariety::all()->pluck('name_text', 'id'))
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





        if ($u->isRole('commissioner')) {
            $form->divider();
            $form->select('status', __('Status'))
                ->options([
                    'Inspection assigned' => 'Inspection assigned',
                    'pending' => 'Pending',
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
                ->options($users)
                ->required(); 
        }
        return $form;
    }
}
