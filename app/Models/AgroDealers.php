<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgroDealers extends Model
{
    use HasFactory;

    protected $fillable = [
        'applicant_id',
        'agro_dealer_reg_number',
        'first_name',
        'last_name',
        'email',
        'physical_address',
        'district',
        'circle',
        'township',
        'town_plot_number',
        'shop number',
        'company_name',
        'retailers_in',
        'business_registration_number',
        'years_in_operation',
        'business_description',
        'trading_license_number',
        'trading_license_period',
        'insuring authority',
        'attachments_certificate',
        'proof_of_payment',
    ];
}
