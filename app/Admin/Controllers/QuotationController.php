<?php

namespace App\Admin\Controllers;

use App\Models\PreOrder;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use \App\Models\Quotation;
use Encore\Admin\Facades\Admin;
use \App\Models\Utils;
Utils::start_session();

class QuotationController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Quotation';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Quotation());
        //disable create button
        $grid->disableCreateButton();

        //organise table in descending order 
        $grid->model()->orderBy('id', 'desc');

        //show the user quotations made by him or to him
        $user = auth()->user();
        $pre_order_id = PreOrder::where('user_id', $user->id)->value('id');
        $grid->model()->where('quotation_by', $user->id)->orWhere('preorder_id', $pre_order_id);

        //disable the edit and delete action buttons if the user is not the one who has submitted the form
        $grid->actions(function ($actions) 
        {
            if ($actions->row->quotation_by != auth()->user()->id) 
            {
                $actions->disableDelete();
            }
            //check the status of the order
            if ($actions->row->status == 'accepted') 
            {
                $actions->disableDelete();
                $actions->disableEdit();
            }

        });

        $grid->column('preorder_id', __('Crop variety'))->display(function ($preorder_id) 
        {
            $crop_variety_id = \App\Models\PreOrder::find($preorder_id)->crop_variety_id;
            return \App\Models\CropVariety::find($crop_variety_id)->crop_variety_name;
        });
        $grid->column('quantity', __('Quantity'));
        $grid->column('price', __('Price'));
        $grid->column('supply_date', __('Supply date'));
        $grid->column('quotation_by', __('Quotation by'))->display(function ($quotation_by) 
        {
            return \App\Models\User::find($quotation_by)->name;
        });
        $grid->column('status', __('Status'))->display(function ($status) 
        {
            return \App\Models\Utils::tell_status($status)?? '-';
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
        $show = new Show(Quotation::findOrFail($id));
        $quotation = Quotation::find($id);
        $preOrder = PreOrder::find($quotation->preorder_id);

        $show->field('crop_variety_id', __('Crop variety'))->as(function () use ($preOrder)
        {
            return \App\Models\CropVariety::find($preOrder->crop_variety_id)->crop_variety_name;
        });
        $show->field('seed_class', __('Seed class'))->as(function () use ($preOrder)
        {
            return $preOrder->seed_class;
        });
        $show->field('quantityy', __('Requested Quantity'))->as(function () use ($preOrder)
        {
            return $preOrder->quantity;
        });
        $show->field('quantity', __('Quantity to be supplied'));
        $show->field('price', __('Price'));
        $show->field('preferred_delivery_date', __('Preferred delivery date'))->as(function () use ($preOrder)
        {
            return $preOrder->preferred_delivery_date;
        });
        $show->field('supply_date', __('Supply date'));
        $show->field('quotation_by', __('Quotation by'));
        $show->field('details', __('Details'));
        $show->field('status', __('Status'))->unescape()->as(function ($status) 
        {
            return \App\Models\Utils::tell_status($status)?? '-';
        });

        //disable the edit and delete action buttons
        $show->panel()->tools(function ($tools) 
        {
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
        $form = new Form(new Quotation());
        $id = intval(request() -> query('preorder_id'));
        //set the pre_order id to the one that has been passed from the button
        if ($form->isCreating()) 
        {
            if (isset($_GET['preorder_id']) && (!isset($_SESSION['preorder_id']))) 
            {
                if ($id > 0) 
                {
                    $_SESSION['preorder_id'] = $id;
                    return redirect(admin_url('quotations/create'));
                }
            }

            if (isset($_SESSION['preorder_id'])) 
            {
                $id = $_SESSION['preorder_id'];
            }

            if (is_null($id)) {
                return admin_error('Warning', "Pre-order ID not found.");
            }
            
            $preOrder = PreOrder::find($id);
            if (!$preOrder) {
                return admin_error('Warning', "Pre-order not found.");
            }
            
            if ($preOrder->user_id == Admin::user()->id) {
                return admin_error('Warning', "You cannot create a quotation for your own pre-order.");
            }

            $form->text('preorder_id', __('Preorder id'))->readonly()->value($id);
            $form->display('crop_variety_id', __('Crop variety'))->with(function () use ($preOrder){
                return \App\Models\CropVariety::find($preOrder->crop_variety_id)->crop_variety_name;
            });
            $form->display('seed_class', __('Seed class'))->default($preOrder->seed_class);
            $form->display('quantity', __('Requested Quantity'))->default($preOrder->quantity);
            $form->text('quantity', __('Quantity'));
            $form->text('price', __('Price'));
            $form->display('preferred_delivery_date', __('Preferred delivery date'))->default($preOrder->preferred_delivery_date);
            $form->date('supply_date', __('Supply date'));
            $form->hidden('quotation_by', __('Quotation by'))->readonly()->value(Admin::user()->id);
           

            $form->textarea('details', __('Details'));
            if ($form->saved(function () 
            {
                if (isset($_SESSION['preorder_id'])) 
                {
                    unset($_SESSION['preorder_id']);
                }

                return redirect(admin_url('quotations'));
            }));
      
        }
        if ($form->isEditing()) 
        {
            //if the user is not the one who created the quotation, then show the edit field
            $id = request()->route()->parameters['quotation'];
            $quotation = $form->model()->find($id);
            $preOrder = PreOrder::find($quotation->preorder_id);
            if ($quotation->quotation_by != Admin::user()->id) 
            {
                        
                    $form->display('preorder_id', __('Preorder id'))->readonly()->value($id);
                    $form->display('crop_variety_id', __('Crop variety'))->with(function () use ($preOrder){
                        return \App\Models\CropVariety::find($preOrder->crop_variety_id)->crop_variety_name;
                    });
                    $form->display('seed_class', __('Seed class'))->default($preOrder->seed_class);
                    $form->display('quantity', __('Requested Quantity'))->default($preOrder->quantity);
                    $form->display('quantity', __('Quantity'));
                    $form->display('price', __('Price'));
                    $form->display('preferred_delivery_date', __('Preferred delivery date'))->default($preOrder->preferred_delivery_date);
                    $form->display('supply_date', __('Supply date'));
                    $form->display('quotation_by', __('Quotation by'))->with(function ($quotation_by) {
                        return \App\Models\User::find($quotation_by)->name;
                    });
                    $form->radio('status', __('Decision on this quotation'))
                    ->required()
                    ->options
                    ([
                        'accepted' => 'Accept',
                        'rejected' => 'Declined',
                    ])
                    ->help("NOTE: Once you accept this quotation, the decision cannot be reversed.")
                    ->when('rejected', function (Form $form) 
                    {
                        $form->textarea('status_comment', __('Reason why declined'))
                        ->help("Optional");
                    })
                    ->when('accepted', function (Form $form) 
                    {
                        $form->radio('payment_method', __('Payment method'))->options
                        ([
                            'cash' => 'Cash',
                            'bank_transfer' => 'Bank transfer',
                            'mobile_money' => 'Mobile money',
                            'cheque' => 'Cheque',
                            

                        ]);
                    });
            }
            else{
            

            }
        }    

        return $form;
    }
}

