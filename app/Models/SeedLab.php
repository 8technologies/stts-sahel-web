<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Encore\Admin\Facades\Admin;


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
        'quantity',
        'testing_methods',
        'germination_test_results',
        'purity_test_results',
        'moisture_content_test_results',
        'additional_tests_results',
        'test_decision',
        'lot_number',
        'mother_lot',
        'reporting_and_signature',
    ];

    public static function boot()
    {
        parent::boot();

        //call back to send a notification to the user
        self::created(function ($model) {
            //Notification::send_notification($model, 'SeedProducer', request()->segment(count(request()->segments())));
        });

        self::updated(function ($model) {
            //Notification::send_notification($model, 'SeedProducer', request()->segment(count(request()->segments())));

            //if the test_decision is marketable ,add it to the marketable seeds table
            if($model->test_decision == 'marketable'){
            $marketable_seed = new MarketableSeed();
            $marketable_seed->user_id = $model->applicant_id;
            $marketable_seed->seed_lab_id = $model->id;
            $marketable_seed->load_stock_id = $model->load_stock_id;
            $marketable_seed->crop_variety_id = $model->crop_variety_id;
            $marketable_seed->quantity = $model->quantity;
            $marketable_seed->save();

            //update the quantity in the load stock table
            $load_stock = LoadStock::find($model->load_stock_id);
            $load_stock->yield_quantity = $load_stock->yield_quantity - $model->quantity;
            $load_stock->save();
        }
        });

        self::updating(function ($model) {
            if (Admin::user()->isRole('basic-user')) {
                $model->status = 'pending';
                $model->inspector_id = null;
                return $model;
            }
        });
    }
}
