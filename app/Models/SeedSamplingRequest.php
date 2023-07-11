<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeedSamplingRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'sample_request_number',
        'applicant_number',
        'load_stock_number',
        'sample_request_date',
        'proof_of_payment',
        'applicant_remarks',
    ];
}
