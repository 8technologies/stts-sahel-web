<?php

namespace App\Models;

use Encore\Admin\Auth\Database\Administrator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Encore\Admin\Facades\Admin;


class SeedLab extends Model
{
    use HasFactory;

    protected $fillable = [
        'sample_request_number',
        'user_id',
        'load_stock_id',
        'crop_variety_id',
        'sample_request_date',
        'proof_of_payment',
        'applicant_remarks',
        'seed_lab_test_report_number',
        'seed_sample_request_number',
        'seed_sample_size',
        'seed_class',
        'quantity',
        'validated_stock',
        'status',
        'status_comment',
        'inspector_id',
        'additional_instructions',
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
            Notification::send_notification($model, 'SeedLab', request()->segment(count(request()->segments())));
        });

        self::updated(function ($model) 
        {
            Notification::update_notification($model, 'SeedLab', request()->segment(count(request()->segments())-1));
        
            if ($model->test_decision == 'marketable') {
                  // Update the quantity in the load stock table
                  $load_stock = LoadStock::find($model->load_stock_id);
                  $load_stock->yield_quantity = $load_stock->yield_quantity - $model->quantity;
                  $load_stock->status = 'tested';
                  $load_stock->save();
                  $model->status = 'marketable';
                  $model->save();
 
            }
            elseif ($model->test_decision == 'not marketable') {
                $model->status = 'not marketable';
                $model->save();
            }

            //if the user is an inspector,update the validated stock

            elseif($model->status == 'lab test assigned'){
                $load_stock = LoadStock::find($model->load_stock_id);
                $load_stock->yield_quantity = $model->validated_stock;
                $load_stock->checked = 1;
                $load_stock->save();
            }
            
        });
        

        self::updating(function ($model) 
        {
            //get the user id from the model and check if the user is a basic user or not
            $user = Administrator::find($model->user_id);
            if ($user->isRole('basic-user')) {
                $model->status = 'pending';
                $model->inspector_id = null;
                return $model;
            }
        });
    }
}
