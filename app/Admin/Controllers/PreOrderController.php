<?php

namespace App\Admin\Controllers;

use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use \App\Models\PreOrder;
use App\Models\Utils;

class PreOrderController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
  
    public function __construct() {
        $this->title = __('admin.form.pre-orders');
    }


    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new PreOrder());
        //order by the latest
        $grid->model()->orderBy('id', 'desc');
        //if the preorder is not made by the user,disable the delete and edit button
        $grid->actions(function ($actions) {
            $user = auth()->user()->id;
            $owner = ((int)(($actions->row['user_id'])));
            if ($owner != $user) {
                $actions->disableDelete();
                $actions->disableEdit();
            }
        });

     
        $grid->column('crop_variety_id', __('admin.form.Crop Variety'))->display(function ($crop_variety_id) {
            $cropVariety = \App\Models\CropVariety::with('crop')->find($crop_variety_id);
        
            if ($cropVariety && $cropVariety->crop) {
                return $cropVariety->crop->crop_name . ' - (' . $cropVariety->crop_variety_name.')';
            }
        
            return 'N/A'; // Fallback in case of missing data
        });
        $grid->column('seed_class', __('admin.form.Seed class'))->display(function ($seed_class) {
            return \App\Models\SeedClass::find($seed_class)->class_name;
        });
        $grid->column('quantity', __('admin.form.Quantity(kgs)'))->display(function ($quantity) {
            return $quantity . ' kgs';
        });
        $grid->column('preferred_delivery_date', __('admin.form.Preferred delivery date'));
        $grid->column('client_name', __('admin.form.Client name'));



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
        $show = new Show(PreOrder::findOrFail($id));


        $show->field('crop_variety_id', __('admin.form.Crop Variety'))->as(function ($crop_variety_id) {
            $cropVariety = \App\Models\CropVariety::with('crop')->find($crop_variety_id);
        
            if ($cropVariety && $cropVariety->crop) {
                return $cropVariety->crop->crop_name . ' - (' . $cropVariety->crop_variety_name.')';
            }
        
            return 'N/A'; // Fallback in case of missing data
        });

        $show->field('seed_class', __('admin.form.Seed class'))->as(function ($seed_class) {
            return \App\Models\SeedClass::find($seed_class)->class_name;
        });
        $show->field('quantity', __('admin.form.Quantity(kgs)'))->as(function ($quantity) {
            return $quantity . ' kgs';
        });
        $show->field('preferred_delivery_date', __('admin.form.Preferred delivery date'));
        $show->field('order_date', __('admin.form.Order date'));
        $show->field('client_name', __('admin.form.Client name'));
        $show->field('client_physical_address', __('admin.form.Client physical address'));
        $show->field('client_contact_number', __('admin.form.Client contact number'));
        $show->field('client_email_address', __('admin.form.Client email address'));
        $show->field('preferred_payment_method', __('admin.form.Preferred payment method'));
        $show->field('seed_delivery_preferences', __('admin.form.Seed delivery preference'));
        $show->field('other_information', __('admin.form.Other information'));
        $show->field('created_at', __('admin.form.Created at'));


        //disable delete button
        $show->panel()->tools(function ($tools) {
            $tools->disableDelete();
            $tools->disableEdit();
          

            //check if the user is not the owner of the pre-order then present a submit quotation button
            $user = auth()->user();
            $id = request()->route()->parameters['pre_order'];
            $preOrder = PreOrder::findOrFail($id);
            if ($user->id != $preOrder->user_id && $user->isRole('research')) {
                $tools->append("<a href='" . admin_url('quotations/create?preorder_id=' . $id) . "' class='btn btn-primary'>SUBMIT QUOTATION</a>");
            }
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
        $form = new Form(new PreOrder());

        //assign user_id to the currently logged in user
        $user = auth()->user();
        if ($form->isCreating()) {
            $form->hidden('user_id')->default($user->id);
        }
        $form->select('crop_variety_id', __('admin.form.Crop Variety'))
        ->options(Utils::get_varieties())
        ->required();
        $form->select(
            'seed_class',
            __('admin.form.Seed generation')
        )->options(
            \App\Models\SeedClass::where('class_name', 'prebase')->pluck('class_name', 'id')
        )->required();
        
        $form->decimal('quantity', __('admin.form.Quantity(kgs)'))->required();
        $form->date('preferred_delivery_date', __('admin.form.Preferred delivery date'))->default(date('Y-m-d'))->required();
        $form->date('order_date', __('admin.form.Order date'))->default(date('Y-m-d'))->required();
        $form->text('client_name', __('admin.form.Client name'))->required();
        $form->text('client_physical_address', __('admin.form.Client physical address'))->required();
        $form->text('client_contact_number', __('admin.form.Client contact number'))->required();
        $form->text('client_email_address', __('admin.form.Client email address'))->required();
        $form->radio('preferred_payment_method', __('admin.form.Preferred payment method'))-> options(
            ['Espèces' => 'Espèces',
            'Carte de débit' => 'Carte de débit',
            'Chèque' => 'Chèque',
            'Mobile money' => 'Mobile Money',
           
            'Bank transfer' => 'Virement bancaire'])->required();
        $form->radio('seed_delivery_preferences', __('admin.form.Seed delivery preference'))-> options(
            ['Ramassage' => 'Ramassage',
            'Livraison' => 'Livraison'])->required();
           
        $form->textarea('other_information', __('admin.form.Other information'));


        //disable tools
        $form->tools(function (Form\Tools $tools) {
            $tools->disableDelete();
            
            
        });

        //disable check boxes
        $form->footer(function ($footer) {
            $footer->disableViewCheck();
            $footer->disableEditingCheck();
            $footer->disableCreatingCheck();
        });
        return $form;
    }
}
