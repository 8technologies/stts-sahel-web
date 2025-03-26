<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use \App\Models\Crop;
use Encore\Admin\Facades\Admin;
use \App\Models\Notification;
use Encore\Admin\Auth\Database\Administrator;


class SeedProducer extends Model
{
    use HasFactory;
    protected $casts = [
        'seed_generation' => 'array',
    ];

     protected $fillable = [
        'user_id',
        'producer_registration_number',
        'seed_generation',
        'name_of_applicant',
        'applicant_phone_number',
        'applicant_email',
        'premises_location',
        'proposed_farm_location',
        'years_of_experience',
        'gardening_history_description',
        'storage_facilities_description',  
        'receipt',
        'status',
        'status_comment',
        'recommendation',
        'inspector_id',
        'grower_number',
        'valid_from',
        'valid_until',
    ];


    public function crops(): BelongsToMany
    {
        $pivotTable = 'crop_seed_producers';

        $relatedModel = Crop::class;

        return $this->belongsToMany($relatedModel, $pivotTable, 'seed_producer_id', 'crop_id');
    }

    
    public static function boot()
    {
        parent::boot();

        //call back to send a notification to the user
        self::created(function ($model) 
        {
            Notification::send_notification($model, 'SeedProducer', request()->segment(count(request()->segments())));
        });


        self::updating(function ($model){
          
        });

        self::updated(function ($model) 
        {
        //call back to send a notification to the user after form is updated
           Notification::update_notification($model, 'SeedProducer', request()->segment(count(request()->segments())-1));
            
           //change the role of the basic user to that of the seed producer if approved
           AdminRoleUser::where([
                'user_id' => $model->user_id,
                'role_id' => 3
            ])->delete();

            if ($model->status == 'accepted') {
                $existingRole = AdminRoleUser::where([
                    'user_id' => $model->user_id,
                    'role_id' => 5
                ])->first();
                // If the user doesn't have the agro-dealer role, add it
                if (!$existingRole) {
                    $new_role = new AdminRoleUser();
                    $new_role->user_id = $model->user_id;
                    $new_role->role_id = 5; // Role ID for agro-dealer
                    $new_role->save();
                }
            
            }
        });

    }


}
