<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\MarketableSeed;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'preorder_id',
        'quotation_id',
        'marketable_id',
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

        static::created(function ($model) {
            Notification::order_notification($model, 'Order', request()->segment(count(request()->segments())));

        });

        //after updating the status of the order, enter the order details to the order table
        static::updated(function ($model) {
            //send notification to the user who made the order
            Notification::order_notification($model, 'Order', request()->segment(count(request()->segments())-1));

            //if order status is confirmed, subtract the quanity from the marketable quantity stock
            if($model->status == 'confirmed' && $model->marketable_id != null){
                $stock = MarketableSeed::find($model->marketable_id);
                $remaining_quantity = ($stock->quantity ?? 0) - $model->quantity;
                $stock->quantity = max(0, $remaining_quantity);
                
                $stock->save();
            }

        });
    }
}
