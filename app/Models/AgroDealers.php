<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgroDealers extends Model
{
    use HasFactory;

    protected $fillable = [
        'agro_dealer_reg_number',
        'first_name',
        'last_name',
        'email',
        'physical_address',
        'district',
        'sub_county',
        'town_plot_number',
        'business_name',
        'dealers_in',
        'business_type',
        'business_registration_number',
        'years_in_operation',
        'business_description',
        'trading_license_info',
        'attachments_certificate',
        'proof_of_payment',
    ];
}
