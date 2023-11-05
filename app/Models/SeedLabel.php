<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeedLabel extends Model
{
    use HasFactory;

    protected $fillable = [
        'seed_label_request_number',
        'user_id',
        'registration_number',
        'seed_lab_id',
        'quantity_of_seed',
        'proof_of_payment',
        'request_date',
        'applicant_remarks',
        'status',
    ];

    public function packages()
    {

        return $this->hasMany(SeedLabelPackage::class, 'seed_label_id');
    }


    //api relationships
    public function labelPackages()
    {
        return $this->belongsToMany(LabelPackage::class, 'seed_label_packages', 'seed_label_id', 'package_id')
            ->withPivot('quantity'); // Add pivot fields as needed
    }

    //boot
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
           
        });

          //call back to send a notification to the user
          self::created(function ($model) 
          {
              Notification::send_notification($model, 'SeedLabel', request()->segment(count(request()->segments())));
          });

          //call back to send a notification to the user
            self::updated(function ($model) 
            {
                //call back to send a notification to the user after form is updated
                Notification::update_notification($model, 'SeedLabel', request()->segment(count(request()->segments())-1));

                // Check if the test_decision is 'marketable' and if a duplicate entry exists in MarketableSeed
               // Check if the test_decision is 'marketable' and if a duplicate entry exists in MarketableSeed
               if ($model->test_decision == 'marketable' && !MarketableSeed::where('seed_lab_id', $model->id)->exists()) {
                // Update the quantity in the load stock table
                $load_stock = LoadStock::find($model->load_stock_id);
                $load_stock->yield_quantity = $load_stock->yield_quantity - $model->quantity;
                $load_stock->save();

              $marketable_seed = new MarketableSeed();
              $marketable_seed->user_id = $model->user_id;
              $marketable_seed->seed_lab_id = $model->id;
              $marketable_seed->load_stock_id = $model->load_stock_id;
              $marketable_seed->crop_variety_id = $model->crop_variety_id;
              $marketable_seed->quantity = $load_stock->yield_quantity - $model->quantity;
              $marketable_seed->save();
      
            
          }
            });
  
    }

}
