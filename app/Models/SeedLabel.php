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
  
    }

}
