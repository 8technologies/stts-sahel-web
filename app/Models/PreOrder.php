<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'crop_variety_id',
        'seed_class',
        'quantity',
        'preferred_delivery_date',
        'order_date',
        'client_name',
        'client_physical_address',
        'client_contact_number',
        'client_email_address',
        'preferred_payment_method',
        'proof_of_payment',
        'seed_delivery_preferences',
        'other_information',
    ];
}
