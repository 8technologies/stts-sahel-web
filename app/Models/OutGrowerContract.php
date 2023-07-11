<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OutGrowerContract extends Model
{
    use HasFactory;

    protected $fillable = [
        'out_grower_contract_number',
        'name_of_applicant',
        'phone_number',
        'registration_number',
        'garden_size',
        'field_name',
        'district',
        'sub_county',
        'village',
        'planting_date',
        'quantity_planted',
        'expected_yield',
        'source_of_seed',
        'source_lot_number',
        'garden_location',
        'garden_details',
        'receipt'
    ];
}
