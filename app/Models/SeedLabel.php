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
            self::updating(function ($model) 
            {
                //call back to send a notification to the user after form is updated
                Notification::update_notification($model, 'SeedLabel', request()->segment(count(request()->segments())-1));


                if($model->status == 'printed')
                {
                    error_log($model);
                    //get the total quantity of the packages
                 
                    $total_quantity = 0;
                    foreach ($model->packages as $package) {
                        $total_quantity += $package['quantity'];
                    }
    
                    // Update the quantity in the load stock table
                    $load_stock_id = SeedLab::find($model->seed_lab_id)->first()->load_stock_id;
                    $load_stock = LoadStock::find(17);
                    $load_stock->yield_quantity = 6000;
                    $load_stock->save();

                    // $marketable_seed = new MarketableSeed();
                    // $marketable_seed->user_id = $model->user_id;
                    // $marketable_seed->seed_lab_id = $model->seed_lab_id;
                    // $marketable_seed->load_stock_id = $load_stock->id;
                    // $marketable_seed->crop_variety_id = $load_stock->crop_variety_id;
                    // $marketable_seed->quantity = $total_quantity;
                    // $marketable_seed->save();
      
                }
         
            });
  
    }

}
