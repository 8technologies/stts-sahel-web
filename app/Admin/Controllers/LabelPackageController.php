<?php

namespace App\Admin\Controllers;

use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use \App\Models\LabelPackage;
use \App\Models\SeedClass;
use Illuminate\Support\Facades\Log;

class LabelPackageController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
  
   
    protected function title()
    {
        return trans('admin.form.Label Packages');
    }


    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new LabelPackage());

        //order by quantity
       $grid->model()->orderBy('quantity', 'asc');

       //add filter by seed generation
         $grid->filter(function ($filter)
            {
                $filter->disableIdFilter();
                $filter->like('package_type', 'Package Type');
                $filter->equal('seed_generation', 'Seed Generation')->select(\App\Models\SeedClass::pluck('class_name', 'id'));
            });

        //order in alphabetical order

        
        $grid->column('package_type', __('admin.form.Package Type'));
        $grid->column('seed_generation', __('Seed Generation'))->display(function ($value) {
            return SeedClass::find($value)->class_name ?? '-';
        })->sortable();
        $grid->column('price', __('admin.form.Price'));
        $grid->column('quantity', __('admin.form.Quantity(kgs)'))->sortable();
       

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
        $show = new Show(LabelPackage::findOrFail($id));

        $show->field('package_type', __('admin.form.Package Type'));
        $show->field('seed_generation', __('Seed Generation'))->as(function ($value) {
            return SeedClass::find($value)->class_name ?? '-';
        });
        $show->field('price', __('admin.form.Price'));
        $show->field('quantity', __('admin.form.Quantity(kgs)'));
      

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new LabelPackage());

        $form->text('package_type', __('admin.form.Package Type'))->required();
        $form->select('seed_generation', __('Seed Generation'))->options(\App\Models\SeedClass::all()->pluck('class_name', 'id'))->required();
        

        if($form->isCreating()){
            $form->multipleSelect('quantity', __('admin.form.Quantity(kgs)'))->options([
                '1' => '1 kgs',
                '5' => '5 kgs',
                '10' => '10 kgs',
                '20' => '20 kgs',
                '50' => '50 kgs',
            ])->required();

            $form->saving(function (Form $form) {
                $quantities = $form->input('quantity'); // Get the selected quantities
            
                // Prevent the main record from being saved
                $form->model()->exists = true;
            
                if ($quantities) {
                    // For each quantity, create a new label package
                    foreach ($quantities as $quantity) {
                        if (!is_null($quantity)) {  // Ensure $quantity is not null before saving
                            $labelPackage = new LabelPackage();
                            $labelPackage->package_type = $form->package_type;
                            $labelPackage->seed_generation = $form->seed_generation;
                            $labelPackage->price = $form->price;
                            $labelPackage->quantity = $quantity; // Assign each individual selected quantity
                            $labelPackage->save();
                        }
                    }
                }
            
                // Do not save the main record again, only create new records for quantities
                return false;
            });
        }

        if ($form->isEditing()){
            $form->select('quantity', __('admin.form.Quantity(kgs)'))->options([
                "1" => '1 kgs',
                "5" => '5 kgs',
                "10" => '10 kgs',
                "20" => '20 kgs',
                "50" => '50 kgs',
            ])->required();

        }

        Log::info($form->quantity);
        
        
        $form->text('price', __('admin.form.Price'))->attribute( 
            [
                'type' => 'number',
                'step' => 'any'
            ]
        )
        ->required();
        
        return $form;
    }
}
