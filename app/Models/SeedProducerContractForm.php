<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeedProducerContractForm extends Model
{
    use HasFactory;

    protected $fillable = [
        'production_contract_number',
        'crop',
        'variety',
        'seed_company_id',
        'producer_first_name',
        'producer_last_name',
        'phone_number',
        'gender',
        'email_address',
        'physical_address',
        'contract_details',
        'start_date',
        'end_date',
        'signature_of_operator',
    ];
}
