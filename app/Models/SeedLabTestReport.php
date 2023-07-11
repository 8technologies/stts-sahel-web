<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeedLabTestReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'seed_lab_test_report_number',
        'seed_sample_request_number',
        'planting_return_id',
        'applicant_name',
        'seed_sample_size',
        'testing_methods',
        'germination_test_results',
        'purity_test_results',
        'moisture_content_test_results',
        'additional_tests_results',
        'test_decision',
        'reporting_and_signature',
    ];
}
