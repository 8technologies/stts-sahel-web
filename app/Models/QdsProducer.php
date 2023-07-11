<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QdsProducer extends Model
{
    use HasFactory;

    protected $fillable = [
        'qds_producer_number',
        'name_of_applicant',
        'applicant_phone_number',
        'applicant_email',
        'applicant_physical_address',
        'farm_location',
        'years_of_experience',
        'crop_and_variety_experience',
        'production_of',
        'has_adequate_land',
        'has_adequate_storage',
        'has_adequate_equipment',
        'has_contractual_agreement',
        'has_field_officers',
        'has_knowledgeable_personnel',
        'land_size',
        'quality_control_mechanisms',
        'receipt'
    ];
}
