<?php

namespace App\Admin\Controllers;

use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use \App\Models\LoadStock;
use \Encore\Admin\Facades\Admin;
use \App\Models\Validation;

use \App\Models\CropDeclaration;

class LoadStockController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'LoadStock';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new LoadStock());
        $user = Admin::user();
        if(!$user->isRole('commissioner')){
            $grid->model()->where('user_id', auth('admin')->user()->id);
        }

        if (!$user->inRoles(['basic-user','grower','agro-dealer'])){
            $grid->disableCreateButton();
        }

        $grid->column('id', __('Id'));
        $grid->column('load_stock_number', __('admin.form.Load stock number'));
        $grid->column('user_id', __('admin.form.Applicant Name'))->display(function ($user_id) {
            return \App\Models\User::find($user_id)->name;
        });
        $grid->column('yield_quantity', __('admin.form.Yield quantity'));
        $grid->column('last_field_inspection_date', __('admin.form.Last field inspection date'));
     
        

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
        $show = new Show(LoadStock::findOrFail($id));

          //check if the user is the owner of the form
          $showable = Validation::checkUser('LoadStock', $id);
          if (!$showable) 
          {
              return(' <p class="alert alert-danger">You do not have rights to view this form. <a href="/admin/load-stocks"> Go Back </a></p> ');
          }

        $show->field('load_stock_number', __('admin.form.Load stock number'));
        $show->field('crop_declaration_id', __('admin.form.Crop Declaration'))->as(function ($value) {
            $crop_variety_id = \App\Models\CropDeclaration::find($value)->crop_variety_id;
            return \App\Models\CropVariety::find($crop_variety_id)->crop_variety_name ?? '-';
        });;
        $show->field('user_id', __('admin.form.Applicant'))->as(function ($value) {
            return \App\Models\User::find($value)->name ?? '-';
        });
        $show->field('registration_number', __('admin.form.Registration number'))->as(function ($value) {
            return \App\Models\SeedProducer::find($value)->producer_registration_number ?? '-';
        });
        $show->field('seed_class', __('admin.form.Seed class'))->as(function ($value) {
            return \App\Models\SeedClass::find($value)->class_name ?? '-';
        });
        $show->field('field_size', __('admin.form.Field size'));
        $show->field('yield_quantity', __('admin.form.Yield quantity'));
        $show->field('last_field_inspection_date', __('admin.form.Last field inspection date'));
        $show->field('load_stock_date', __('admin.form.Load stock date'));
        $show->field('last_field_inspection_remarks', __('admin.form.Last field inspection remarks'));
       
        //disable edit button and delete button
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
        $form = new Form(new LoadStock());
        $user = auth()->user();
           
        if ($form->isCreating()) 
        {
            $form->hidden('user_id')->default($user->id);

            //if form is saving get the crop variety id from the crop declaration
            $form->saving(function (Form $form) {
                $crop_declaration = CropDeclaration::find($form->crop_declaration_id);
                $user = auth()->user();
                if(!$user->isRole('agro-dealer')){   
                    $form->crop_variety_id = $crop_declaration->crop_variety_id;
                    $form->last_field_inspection_date = $crop_declaration->updated_at->format('Y-m-d');
                    $form->registration_number = $crop_declaration->seed_producer_id;
                }else{
                    if($form->crop_declaration_id != null)
                    {
                        if($form->crop_variety_id != $crop_declaration->crop_variety_id){
                            return back()->withInput()->withErrors(['crop_variety_id' => 'The crop variety selected does not match the crop variety in the crop declaration']);
                        }
                    }
                }
            });
        }

         //check if the form is being edited
         if ($form->isEditing()) 
         {
             //get request id
             $id = request()->route()->parameters()['load_stock'];
             //check if its valid to edit the form
             Validation::checkFormEditable($form, $id, 'LoadStock');
         }

        $form->saved(function (Form $form) 
        {
            admin_toastr(__('admin.form.Load stock saved successfully'), 'success');
            return redirect('/admin/load-stocks');
        });
        $form->text('load_stock_number', __('admin.form.Load stock number'))->default('LS'.rand(1000, 100000))->readonly();

        //get all crop varieties
        $crop_varieties = \App\Models\CropVariety::all();
        //get all seed classes
        $seed_classes = \App\Models\SeedClass::all();
        $crop_declarations = CropDeclaration::where('user_id', $user->id)
        ->where('status', 'accepted')->get();
        if(!$user->isRole('agro-dealer')){
            $form->select('crop_declaration_id', __('admin.form.Crop Declaration'))->options($crop_declarations->pluck('field_name', 'id'))->required();
            $form->hidden('crop_variety_id', __('Crop Variety'));
            $form->hidden('last_field_inspection_date', __('Date'));
            $form->hidden('registration_number',__('admin.form.producer Registration number'));

            
        }else{
            $form->select('crop_declaration_id', __('admin.form.Crop Declaration'))->options($crop_declarations->pluck('field_name', 'id'));
            $form->select('crop_variety_id', __('admin.form.Crop Variety'))
            ->options(\App\Models\CropVariety::all()->pluck('crop_variety_name', 'id'))
            ->required();
            $form->date('last_field_inspection_date', __('admin.form.Last field inspection date'))->default(date('Y-m-d'));
        }
        
        
        $form->select('seed_class', __('admin.form.Seed class'))->options($seed_classes->pluck('class_name', 'id'))->required();
        $form->decimal('field_size', __('admin.form.Field size'));
        $form->decimal('yield_quantity', __('admin.form.Yield quantity'));
       
        $form->date('load_stock_date', __('admin.form.Load stock date'))->default(date('Y-m-d'));
        $form->textarea('last_field_inspection_remarks', __('admin.form.Last field inspection remarks'));
     

        //disable edit button and delete button
        $form->tools(function (Form\Tools $tools) {
            $tools->disableDelete();
            $tools->disableView();
        });

        return $form;
    }
}
