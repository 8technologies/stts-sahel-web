<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeedLabel extends Model
{
    use HasFactory;

    protected $fillable = [
        'seed_label_request_number',
        'applicant_name',
        'registration_number',
        'seed_lab_id',
        'label_packages',
        'quantity_of_seed',
        'proof_of_payment',
        'request_date',
        'applicant_remarks',
    ];

}
