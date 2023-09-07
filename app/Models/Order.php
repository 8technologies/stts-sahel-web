<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'preorder_id',
        'quotation_id',
        'quantity',
        'price',
        'supply_date',
        'order_by',
        'details',
        'status',
        'status_comment',
        'payment_method',
        'order_number',
        'order_date',
        'supplier',
    ];


    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {

        });

        //after updating the status of the order, enter the order details to the order table
        static::updated(function ($model) {
            //send notification to the user who made the order
            Notification::order_notification($model, 'Order', request()->segment(count(request()->segments())-1));

        });
    }
}
