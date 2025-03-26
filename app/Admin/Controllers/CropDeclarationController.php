<?php

namespace App\Admin\Controllers;

use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use \App\Models\CropDeclaration;
use App\Models\CropVariety;
use App\Models\SeedProducer;
use App\Models\Utils;
use Encore\Admin\Facades\Admin;
use \App\Models\Validation;
use Illuminate\Support\Facades\Log;

class CropDeclarationController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected function title()
    {
        return trans('admin.form.Crop Declaration');
    }


    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new CropDeclaration());
       
        //function to show the loggedin user only what belongs to them
        Validation::showUserForms($grid);

        //order of table
        $grid->model()->orderBy('id', 'desc');

        //disable action buttons appropriately
        Utils::disable_buttons('CropDeclaration', $grid);

         //disable batch and export actions
         Utils::disable_batch_actions($grid);

        //filter by name
        $grid->filter(function ($filter) 
        {
            // Remove the default id filter
            $filter->disableIdFilter();
            $filter->like('user_id', 'Applicant')->select(\App\Models\User::pluck('name', 'id'));
        
        });
    
        $grid->column('user_id', __('admin.form.Applicant'))->display(function ($user_id) {
            return \App\Models\User::find($user_id)->name;
        }); 
        $grid->column('crop_variety_id', __('admin.form.Crop Variety'))->display(function ($crop_variety_id) {
            return CropVariety::find($crop_variety_id)->crop_variety_name;
        });
        $grid->column('garden_size', __('admin.form.Garden size(Acres)'));
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

         //delete notification after viewing the form
         Utils::delete_notification('CropDeclaration', $id);

         //check if the user is the owner of the form
         $showable = Validation::checkUser('CropDeclaration', $id);
         if (!$showable) 
         {
             return(' <p class="alert alert-danger">You do not have rights to view this form. <a href="/seed-producers"> Go Back </a></p> ');
         }
 
        $show->field('user_id', __('admin.form.Applicant Name'))->as(function ($user_id) {
            return \App\Models\User::find($user_id)->name;
        });
       
        $show->field('crop_variety_id', __('admin.form.Crop Variety'))->as(function ($crop_variety_id) {
            return CropVariety::find($crop_variety_id)->crop_variety_name;
        });

        $show->field('seed_class_id', __('admin.form.Seed generation'))->as(function ($seed_class) {
            return \App\Models\SeedClass::find($seed_class)->class_name;
        });

        $show->field('out_grower_id', __('admin.form.Out-grower'))->as(function ($out_grower_id) {
            return \App\Models\OutGrower::find($out_grower_id)->name ?? 'No out-grower selected';
        });

        $show->field('phone_number', __('admin.form.Phone number'));
        $show->field('garden_size', __('admin.form.Garden size(Acres)'));
        $show->field('field_name', __('admin.form.Field name'));
        $show->field('region', __('admin.form.Region'));
        $show->field('department', __('admin.form.Department'));
        $show->field('commune', __('admin.form.Commune'));
        $show->field('village', __('admin.form.Village'));
        $show->field('planting_date', __('admin.form.Planting date'));
        $show->field('crop_declaration_period', __('admin.form.Crop declaration period'));
        $show->field('quantity_of_seed_planted', __('admin.form.Quantity of seed planted(kgs)'));
        $show->field('expected_yield', __('admin.form.Expected yield(tons)'));
        $show->field('seed_supplier_name', __('admin.form.Seed supplier name'));
        $show->field('seed_supplier_registration_number', __('admin.form.Seed supplier registration number'));
        $show->field('source_lot_number', __('admin.form.Source lot number'));
        $show->field('origin_of_variety', __('admin.form.Origin of variety'));
        $show->field('garden_location_latitude', __('admin.form.Garden location latitude'));
        $show->field('garden_location_longitude', __('admin.form.Garden location longitude'));

        // $show->field('garden_location_latitude', __('admin.form.Garden location'))->as(function ($latitude) {
        //     return view('admin.show_map', ['latitude' => $latitude, 'longitude' => $this->garden_location_longitude]);
        // })->unescape();
       
        $show->field('status', __('admin.form.Status'))->as(function ($status) {
            return Utils::tell_status($status);
        })->unescape();
        $show->field('remarks', __('admin.form.Remarks'))->as(function ($remarks) {
            return $remarks == null ? __('admin.form.No remarks yet') : $remarks;
        });

        //if the user is a commissioner, show the inspector
        if ($user->isRole('commissioner')) 
        {
            $show->field('inspector_id', __('admin.form.Inspector'))->as(function ($inspectorId) {
                return $inspectorId ? \App\Models\User::find($inspectorId)->name : __('admin.form.No inspector assigned yet');
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
       
        $form = new Form(new CropDeclaration());

        $user = auth()->user();

        //When form is creating, assign user id
        if ($form->isCreating()) 
        {
            $form->hidden('user_id')->default($user->id);
        }

        //check if the form is being edited
        if ($form->isEditing()) 
        {
            //get request id
            $id = request()->route()->parameters()['crop_declaration'];
            //check if its valid to edit the form
            Validation::checkFormEditable($form, $id, 'CropDeclaration');
        }

        //onsaved return to the list page
        $form->saved(function (Form $form) 
        {
            admin_toastr(__('admin.form.Form submitted successfully'), 'success');
            return redirect('/crop-declarations');
        });
       
        //admin, inspector and developer
        if ($user->inRoles(['commissioner','developer'])) 
        {
            $form->display('crop_variety_id', __('admin.form.Crop variety'))
                ->with(function ($crop_variety_id) {
                    return CropVariety::find($crop_variety_id)->crop_variety_name;
                })
                ->required();

            $form->display('seed_class_id', __('admin.form.Seed generation'))
                ->with(function ($seed_class) {
                    return \App\Models\SeedClass::find($seed_class)->class_name;
                })
                ->required();


            $form->display('phone_number', __('admin.form.Phone number'));
            $form->display('garden_size', __('admin.form.Garden size(Acres)'));
            $form->display('field_name', __('admin.form.Field name'));
            $form->display('region', __('admin.form.Region'));
            $form->display('department', __('admin.form.Department'));
            $form->display('commune', __('admin.form.Commune'));
            $form->display('village', __('admin.form.Village'));
            $form->display('crop_declaration_period', __('admin.form.Crop declaration period'));
            $form->display('planting_date', __('admin.form.Planting date'))->default(date('Y-m-d'));
            $form->display('quantity_of_seed_planted', __('admin.form.Quantity of seed planted(kgs)'));
            $form->display('expected_yield', __('admin.form.Expected yield(tons)'));
            $form->display('seed_supplier_name', __('admin.form.Seed supplier name'));
            $form->display('seed_supplier_registration_number', __('admin.form.Seed supplier registration number'));
            $form->display('source_lot_number', __('admin.form.Source lot number'));
            $form->display('origin_of_variety', __('admin.form.Origin of variety'));
            $form->display('garden_location_latitude', __('admin.form.Garden location latitude'))->rules('required|numeric|digits:10|between:-9999.999999,9999.999999', [
                'numeric' => 'Coordinates must be a numeric value.',
                'digits'  => 'Coordinates must have exactly 10 digits in total.',
                'between' => 'Coordinates must be between -9999.999999 and 9999.999999.',
            ])
            ->required();
            $form->display('garden_location_longitude', __('admin.form.Garden location longitude'))->rules('required|numeric|digits:10|between:-9999.999999,9999.999999', [
                'numeric' => 'Coordinates must be a numeric value.',
                'digits'  => 'Coordinates must have exactly 10 digits in total.',
                'between' => 'Coordinates must be between -9999.999999 and 9999.999999.',
            ])
            ->required();
            $form->display('details', __('admin.form.Provide more details about the garden'));

            $form->divider(__('admin.form.Administrator decision'));
            $form->radioButton('status', __('admin.form.Status'))
            ->options([
                'rejected' => __('admin.form.Rejected'),
                'halted' => __('admin.form.Halted'),
                'inspector assigned' => __('admin.form.Assign Inspector'),

            ])
            ->when('in', ['rejected', 'halted'], function (Form $form) {
                $form->textarea('status_comment', __('admin.form.Status comment'));
            })
            ->when('inspector assigned', function (Form $form) {

                //get all inspectors
                $inspectors = \App\Models\Utils::get_inspectors();
                $form->select('inspector_id', __('admin.form.Inspector'))
                    ->options($inspectors)->required();
            })->required();

            
        }
        
        //basic user
        else 
        {
            //check if the user has a seed producer account
            $seed_producer = SeedProducer::where('user_id', $user->id)->first();
            if ($seed_producer != null) 
            {
                $form->select('out_grower_id', __('admin.form.Out-grower'))
                ->options(Utils::get_out_growers($seed_producer->id));
            
            }

            $form->select('crop_variety_id', __('admin.form.Crop Variety'))
                ->options(Utils::get_varieties())
                ->required();

            
            //get the user role
            $userRoles = $user->roles->pluck('slug')->toArray(); // Get all roles
            $filteredRoles = array_filter($userRoles, fn($role) => $role !== 'agro-dealer'); // Remove 'Agro_dealer'

            // If there are any remaining roles, take the first one, otherwise default to null or another fallback
            $userRole = !empty($filteredRoles) ? reset($filteredRoles) : null;

            // Log::info($userRoles);
            // Log::info("Selected Role: " . $userRole);

            $seedClasses = \App\Models\Utils::getSeedClassNamesByRoleSlug($userRole);
            $form->select('seed_class_id', __('admin.form.Seed generation'))
            ->options($seedClasses )
            ->required();

            
            $form->text('phone_number', __('admin.form.Phone number'))->required();
            $form->decimal('garden_size', __('admin.form.Garden size(Acres)'))->required();
            
            $randomFieldName = 'FIELD' . mt_rand(100, 999);
            $form->hidden('field_name', __('admin.form.Field name'))->default($randomFieldName)->required();
            $form->select('region', __('admin.form.Region'))
                ->options(\App\Models\Region::pluck('name', 'name')->toArray())
                ->load('department', '/admin/departments') // Load departments dynamically
                ->required();
            $form->select('department', __('admin.form.Department'))
                ->options(function ($value) {
                    return $value ? [$value => $value] : [];
                })
                ->required();
            $form->text('commune', __('admin.form.Commune'))->required();
            $form->text('village', __('admin.form.Village'))->required();            
            $form->radio('crop_declaration_period', __('admin.form.Crop declaration period'))
            ->options([
                'rain season' => __('admin.form.Rain season(1st April to 30th June)'),
                'dry season' => __('admin.form.Dry season( 15th August to 31st October)')
            ])
            ->required();
            $form->date('planting_date', __('admin.form.Planting date'))->default(date('Y-m-d'))->required();
            $form->text('quantity_of_seed_planted', __('admin.form.Quantity of seed planted(kgs)'))->attribute(
                [
                    'type' => 'number',
                    'min' => 0,
                    'step' => 'any', // 'any' allows any decimal input
                ]
            )->required();
            $form->text('expected_yield', __('admin.form.Expected yield(tons)'))->attribute([
                'type' => 'number',
                'min' => 0,
                'step' => 'any', // 'any' allows any decimal input
            ])->required();
            
            $form->text('seed_supplier_name', __('admin.form.Seed supplier name'));
            $form->text('seed_supplier_registration_number', __('admin.form.Seed supplier registration number'));
            $form->text('source_lot_number', __('admin.form.Source lot number'))->required();
            $form->text('origin_of_variety', __('admin.form.Origin of variety'))->required();
            //add a get gps coordinate button
            $form->html('<button type="button" id="getLocationButton">' . __('admin.form.Get GPS Coordinates') . '</button>');

            $form->decimal('garden_location_latitude', __('admin.form.Garden location latitude'))->attribute([
                'id' => 'latitude',   
            ])->required();
            $form->decimal('garden_location_longitude', __('admin.form.Garden location longitude'))->attribute([
                'id' => 'longitude',
            ])->required();
            
            //script to get the gps coordinates
            Admin::script(<<<SCRIPT
                document.getElementById('getLocationButton').addEventListener('click', function() {
                    if ("geolocation" in navigator) {
                        navigator.geolocation.getCurrentPosition(function(position) {
                            document.getElementById('latitude').value = position.coords.latitude;
                            document.getElementById('longitude').value = position.coords.longitude;
                        });
                    } else {
                        alert('Geolocation is not supported by your browser.');
                    }
                });
            SCRIPT);
         
            $form->textarea('details', __('admin.form.Provide more details about the garden'));
            $form->file('proof_of_payment', __('admin.form.Proof of payment'))->rules('required|mimes:pdf,png,jpeg,jpg,')->help('Upload a pdf/png/jpeg/jpg file');
            $form->hidden('status')->default('pending');
            $form->hidden('inspector_id')->default(null);

        }

        //disable delete and view button
        $form->tools(function (Form\Tools $tools) 
        {
            $tools->disableDelete();
            $tools->disableView();
        });

        //disable checkboxes
        $form->disableViewCheck();
        $form->disableEditingCheck();
        $form->disableCreatingCheck();

        return $form;
    }
}
