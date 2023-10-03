<?php

namespace App\Models;

use Encore\Admin\Facades\Admin;
use Encore\Admin\Middleware\Bootstrap;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    use HasFactory;

    protected $fillable = [
        'preorder_id',
        'quantity',
        'price',
        'supply_date',
        'quotation_by',
        'quotation_to',
        'payment_method',
        'details',
        'status',
        'status_comment',
    ];


    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->quotation_by = auth('api')->user() ? auth('api')->user()->id : Admin::user()->id;

        });

        //after updating the status of the quotation, enter the order details to the order table
        static::updated(function ($model) {
            //send notification to the user who made the quotation
            Notification::update_notification($model, 'Quotation', request()->segment(count(request()->segments())-1));

            //check if the person editing the quotation is not the person who made it
                if ($model->status == 'accepted') {
                    $order = new Order();
                    $order->preorder_id = $model->preorder_id;
                    $order->quotation_id = $model->id;
                    $order->quantity = $model->quantity;
                    $order->price = $model->price;
                    $order->supply_date = $model->supply_date;
                    $order->order_by = Admin::user()->id;
                    $order->order_number = rand(100, 999999);
                    $order->payment_method = $model->payment_method;
                    $order->details = $model->details;
                    $order->status = 'pending';
                    $order->supplier = $model->quotation_by;
                    $order->status_comment = $model->status_comment;
                    $order->order_date = date('Y-m-d');
                    $order->save();
                }
           
        });
    }
}
