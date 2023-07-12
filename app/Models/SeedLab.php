<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeedLab extends Model
{
    use HasFactory;

    protected $fillable = [
        'sample_request_number',
        'applicant_id',
        'load_stock_id',
        'sample_request_date',
        'proof_of_payment',
        'applicant_remarks',

        'seed_lab_test_report_number',
        'seed_sample_request_number',
        'seed_sample_size',
        'seed_class',
        'testing_methods',
        'germination_test_results',
        'purity_test_results',
        'moisture_content_test_results',
        'additional_tests_results',
        'test_decision',
        'lot_number',
        'reporting_and_signature',
    ];

    public static function boot()
    {
        parent::boot();

        //call back to send a notification to the user
        self::created(function ($model) 
        {
            //Notification::send_notification($model, 'SeedProducer', request()->segment(count(request()->segments())));
        });

        self::updated(function ($model) 
        {
            //Notification::send_notification($model, 'SeedProducer', request()->segment(count(request()->segments())));
        });

        self::updating(function ($model) 
        {
            //Notification::send_notification($model, 'SeedProducer', request()->segment(count(request()->segments())));
        });

    }
}
