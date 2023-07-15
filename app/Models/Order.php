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
}
