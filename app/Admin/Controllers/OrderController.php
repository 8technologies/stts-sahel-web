<?php

namespace App\Admin\Controllers;

use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use \App\Models\Order;
use \App\Models\PreOrder;
use \App\Models\MarketableSeed;
use \App\Models\Utils;
use \App\Models\User;
use Encore\Admin\Facades\Admin;


class OrderController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */

     
     protected function title()
     {
         return trans('admin.form.Order');
     }
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Order());

        //disable create button 
        $grid->disableCreateButton();

        //order of table
       $grid->model()->orderBy('id', 'desc');

       //disable batch and export actions
       Utils::disable_batch_actions($grid);

    
        //check if the user is the one who made the order and disable the edit button
        $grid->actions(function ($actions) {
            if ($actions->row->order_by == Admin::user()->id) {
                $actions->disableDelete();
                //check the status of the order and disable the edit button if the order is not pending
                if($actions->row->status != 'pending')
                {
                    $actions->disableEdit();
                }
            }else{
               //check the status of the order and disable the edit button if the order is confirmed
                if($actions->row->status == 'confirmed')
                {
                    $actions->disableEdit();
                }
                $actions->disableDelete();
            }
           
        });


        //only view orders made by you or to you
        $grid->model()->where('order_by', '=', Admin::user()->id)->orWhere('supplier', '=', Admin::user()->id);

        $grid->column('order_number', __('admin.form.Order number'));

        //check if pre order id is null
        $grid->column('preorder_id', __('admin.form.Crop Variety'))->display(function ($preorder_id) 
        {
            if($preorder_id == null)
            {
                $marketable_id = $this->marketable_id;
                $crop_variety_id = MarketableSeed::find($marketable_id)->crop_variety_id;
                return \App\Models\CropVariety::find($crop_variety_id)->crop_variety_name;
            }
            else
            {
                $crop_variety_id = PreOrder::find($preorder_id)->crop_variety_id;
                return \App\Models\CropVariety::find($crop_variety_id)->crop_variety_name;
            }
        });
       
        $grid->column('quantity', __('admin.form.Quantity'))->display(function ($quantity) 
        {
            return $quantity.' Kgs';
        });
  
        $grid->column('order_date', __('admin.form.Order date'));
        $grid->column('order_by', __('admin.form.Order by'))->display(function ($order_by) 
        {
            return User::find($order_by)->name;
        });
        $grid->column('status', __('admin.form.Status'))->display(function ($status) 
        {
            return Utils::tell_status($status)?? '-';
        })->sortable();

        
            //confirm order button
            $grid->column('id', __('Confirm Delivery'))->display(function ($id) 
            {
                $order = Order::findOrFail($id);
                $confirmedClass =  $order->status == 'confimed' ? 'btn-success' : 'btn-primary';
                $confirmedText =  $order->status == 'confirmed' ? __('admin.form.Confirmed') : __('admin.form.Confirm delivery');
                if( $order->status == 'confirmed') 
                {
                    return "<a  class='btn btn-success' data-id='{$id} ' disabled>$confirmedText</a>";
                }
                if($order->status == 'delivered' )
                {
                   if($order->order_by == Admin::user()->id)
                   {
                     return "<a id='confirm-print-{$id}' href='" . route('delivery.confirm', ['id' => $id]) . "' class='btn btn-xs $confirmedClass confirm-print' data-id='{$id}'>$confirmedText</a>";
                    }
                }  
            })->sortable();
        
            // css styling the button to blue initially
            Admin::style('.btn-blue {color: #fff; background-color: #0000FF; border-color: #0000FF;}');
            
            //Script to edit the form status field to 2 on click of the confirm order button
            Admin::script
            ('
                $(".confirm-print").click(function(e) 
                {
                    e.preventDefault();
                    var id = $(this).data("id");
                    var url = "' . route('delivery.confirm', ['id' => ':id']) . '";
                    url = url.replace(":id", id);
                    var button = $("#confirm-print-" + id);
                    $.ajax(
                        {
                            url: url,
                            type: "PUT",
                            data: 
                            {
                                _method: "PUT",
                                _token: LA.token,
                                status: "confirmed",
                            },
                            success: function (data) 
                            {
                                $.pjax.reload("#pjax-container");
                                toastr.success("Order received successfully");
                
                            }
                        });
                });
            ');
         
      
      
      

        return $grid;
    }

    public function confirm($id)
    {
        $print = Order::findOrFail($id);
        $print->status = 'confirmed'; 
        $print->save();
        return response()->json(['status' => 'success']);
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Order::findOrFail($id));
        
         //delete notification after viewing the form
         Utils::delete_notification('Order', $id);


        $order = Order::find($id);
        $preOrder = PreOrder::find($order->preorder_id);
        
        $show->field('order_number', __('admin.form.Order number'));
        $show->field('order_date', __('admin.form.Order date'));

        $show->field('crop_variety_id', __('admin.form.Crop Variety'))->as(function () use ($preOrder)
        {
            //check if pre order id is null
            if($preOrder == null)
            {
                $marketable_id = $this->marketable_id;
                $crop_variety_id = MarketableSeed::find($marketable_id)->crop_variety_id;
                return \App\Models\CropVariety::find($crop_variety_id)->crop_variety_name;
            }
            else
            {
                $crop_variety_id = PreOrder::find($preOrder->id)->crop_variety_id;
                return \App\Models\CropVariety::find($crop_variety_id)->crop_variety_name;
            }
    
        });
        $show->field('seed_class', __('admin.form.Seed class'))->as(function () use ($preOrder)
        {
            //check if pre order id is null use the marketable id to find the seed class
            if($preOrder == null)
            {
                $marketable_id = $this->marketable_id;
                $load_stock_id = MarketableSeed::find($marketable_id)->load_stock_id;
                $seed_class_id = \App\Models\LoadStock::find($load_stock_id)->seed_class;
                return \App\Models\SeedClass::find($seed_class_id)->class_name;
            }
            else
            {
               
                return \App\Models\SeedClass::find($preOrder->seed_class)->class_name;
            }

        });
    
        $show->field('quantity', __('admin.form.Quantity to be supplied'))->as(function ($quantity) 
        {
            return $quantity.' Kgs';
        });
        $show->field('price', __('admin.form.Price'))->as(function ($price) 
        {
            return $price ?? '-';
        });
        $show->field('supply_date', __('admin.form.Supply date'))->as(function ($supply_date) 
        {
            return $supply_date ?? '-';
        });
        $show->field('order_by', __('admin.form.Order by'))->as(function ($order_by) 
        {
            return User::find($order_by)->name;
        });
        $show->field('details', __('admin.form.Details'));
        $show->field('status', __('admin.form.Status'))->as(function ($status) 
        {
            return Utils::tell_status($status)?? '-';
        })->unescape();
     
      //disable action button
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
        $form = new Form(new Order());
   
        //set the pre_order id to the one that has been passed from the button
        if ($form->isCreating()) 
        {
                if (request()->has('marketable_id') && !session()->has('marketable_id')) {
                $id = request()->input('marketable_id');
                session(['marketable_id' => $id]);
            }
            
            if (session()->has('marketable_id')) {
                $id = session('marketable_id');
            }
           
            if (is_null($id)) {
                return admin_error('Warning', "Marketable seed id  not found.");
            }
            
            $marketableSeed = MarketableSeed::find($id);
            if (!$marketableSeed) {
                return admin_error('Warning', "Marketable seed  not found.". $id);
            }

            if ($marketableSeed->user_id == Admin::user()->id) {
                return admin_error('Warning', "You cannot create an order for your own seed.");
            }
            //display the crop variety name
            $form->display('marketable_id', __('admin.form.Crop Variety'))->with(function ($marketable_id) use ($marketableSeed)
            {
                return \App\Models\CropVariety::find($marketableSeed->crop_variety_id)->crop_variety_name;
            });

            //display the seed class
            $form->display('seed_class', __('admin.form.Seed generation'))->with(function () use ($marketableSeed)
            {
                $load_stock_id = $marketableSeed->load_stock_id;
                $seed_class_id = \App\Models\LoadStock::find($load_stock_id)->seed_class;
                return \App\Models\SeedClass::find($seed_class_id)->class_name;
            });

            //display the available quantity
            $form->display('available_quantity', __('admin.form.Available quantity'))->with(function () use ($marketableSeed)
            {
                return $marketableSeed->quantity.' Kgs';
            });
            
            $form->text('order_number', __('admin.form.Order number'))->default(rand(100, 999999))->readonly();

            $form->display('order_by', __('admin.form.Order by'))->with(function () use ($marketableSeed)
            {
                return User::find($marketableSeed->user_id)->name;
            });
          
        
            $form->decimal('quantity', __('admin.form.Quantity(kgs)'))->required();
            $form->date('order_date', __('admin.form.Order date'))->default(date('Y-m-d'));
            $form->textarea('details', __('admin.form.Details'));
            $form->radio('payment_method', __('admin.form.Payment method'))->options([
                'Espèces' => 'Espèces',
            'Carte de débit' => 'Carte de débit',
            'Chèque' => 'Chèque',
            'Mobile money' => 'Mobile Money',
           
            'Bank transfer' => 'Virement bancaire'])->required();

            $form->hidden('supplier')->default($marketableSeed->user_id);
            $form->hidden('marketable_id')->default($marketableSeed->id);
            $form->hidden('order_by')->default(Admin::user()->id);
            //if saving the form assign supplier id to the authenticated user
            $form->saving(function (Form $form) use ($marketableSeed)
            {
                // Check if the quantity is available in the marketable seed is less than the quantity ordered
                if ($form->quantity > $marketableSeed->quantity) {
                    $form->ignoreSaving();
                    admin_error('Warning', 'The quantity ordered is more than the available quantity');
                    return back();
                }
              
            });


        }

        $form->saved(function (Form $form) 
        {
            if (session()->has('marketable_id')) {
                session()->forget('marketable_id');
            }
        
            return redirect(admin_url('orders'));
        });
        
        
        if ($form->isEditing() )
        {
            
            //find the user who made the order
            $order_id = request()->route()->parameters()['order'];
            $order = Order::find($order_id);

            //if saving the form check if the quantity is available in the marketable seed is less than the quantity ordered
            $form->saving(function (Form $form) use ($order) 
            {
                
                // Check if the quantity is available in the marketable seed is less than the quantity ordered
                if ($order->marketable_id != null) 
                {
                    $stock = MarketableSeed::findOrFail($order->marketable_id);
                    if($order->order_by ==  Admin::user()->id) {
                       
                        if ($form->quantity > $stock->quantity) {
                            error_log('supplier is editing 2');
                            $form->ignoreSaving();
                            admin_error('Warning', 'The quantity ordered is more than the available stock ' . $stock->quantity . ' Kgs');
                            return back();
                        }
                    }else{
                        if($form->status != 'cancelled'){
                            if ($form->quantity > $stock->quantity) {
                                error_log('supplier is editing 2');
                                $form->ignoreSaving();
                                admin_error('Warning', 'The quantity ordered is more than the available stock ' . $stock->quantity . ' Kgs');
                                return back();
                            }
                    }
                    }
                }
            });

            if($order->order_by == Admin::user()->id)
            {
               
                $form->text('order_number', __('admin.form.Order number'))->default(rand(100, 999999))->readonly();
                $form->decimal('quantity', __('admin.form.Quantity(kgs)'))->required();
                $form->date('order_date', __('admin.form.Order date'))->default(date('Y-m-d'));
                $form->textarea('details', __('admin.form.Details'));
                $form->radio('payment_method', __('admin.form.Payment method'))->options([
                    'cash' => 'Cash',
                    'bank_transfer' => 'Bank transfer',
                    'mobile_money' => 'Mobile money',
                    'cheque' => 'Cheque',
    
    
                ])->required();
            }
            else
            {
                $form->display('order_number', __('admin.form.Order number'));

                $form->display('order_by', __('admin.form.Order by'))->with(function ($order_by) 
                {
                    return User::find($order_by)->name;
                });

                //check if pre order id is null use the marketable id to find the crop variety
                $form->display('preorder_id', __('admin.form.Crop Variety'))->with(function ($preorder_id) use ($order)
                {
                    if($preorder_id == null)
                    {
                        $marketable_id = $order->marketable_id;
                        $crop_variety_id = MarketableSeed::find($marketable_id)->crop_variety_id;
                        return \App\Models\CropVariety::find($crop_variety_id)->crop_variety_name;
                    }
                    else
                    {
                        $crop_variety_id = PreOrder::find($preorder_id)->crop_variety_id;
                        return \App\Models\CropVariety::find($crop_variety_id)->crop_variety_name;
                    }
                });
            
                
                $form->text('quantity', __('admin.form.Quantity(kgs)'))->readonly();
                $form->display('price', __('admin.form.Price'));
                $form->display('order_date', __('admin.form.Order date'));
                $form->display('details', __('admin.form.Details'));
                $form->radio('status', __('admin.form.Status'))
                ->options([
                    'processing' => __('admin.form.Processing'), 
                    'shipping' => __('admin.form.Shipping'),
                    'delivered' => __('admin.form.Delivered'),
                    'cancelled' => __('admin.form.Cancelled'),
                ]);
                $form->text('status_comment', __('admin.form.Comment')); 
            }
            
              
        
        }
       

        //disable  action button
        $form->tools(function (Form\Tools $tools) {
            $tools->disableView();
            $tools->disableDelete();
        });

        //disable checkboxes
        $form->footer(function ($footer) {
            $footer->disableViewCheck();
            $footer->disableEditingCheck();
            $footer->disableCreatingCheck();
        });

        return $form;
    }
}
