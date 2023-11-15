<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OutGrower extends Model
{
    use HasFactory;

    protected $fillable = [
        'contract_number',
        'seed_company_name',
        'seed_company_registration_number',
        'first_name',
        'last_name',
        'phone_number',
        'gender',
        'email_address',
        'district',
        'sub_county',
        'town_street',
        'plot_number',
        'community',
        'valid_from',
        'valid_to',
        'signature'
    ];

}
