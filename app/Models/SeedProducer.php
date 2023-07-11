<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use \App\Models\Crop;
use \App\Models\Notification;


class SeedProducer extends Model
{
    use HasFactory;

     protected $fillable = [
        'user_id',
        'producer_registration_number',
        'producer_category',
        'name_of_applicant',
        'applicant_phone_number',
        'applicant_email',
        'premises_location',
        'proposed_farm_location',
        'years_of_experience',
        'gardening_history_description',
        'storage_facilities_description',  
        'have_adequate_isolation',
        'labor_details',
        'receipt',
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

        self::updated(function ($model) 
        {
        //call back to send a notification to the user after form is updated
            Notification::update_notification($model, 'SeedProducer', request()->segment(count(request()->segments())-1));
            if($model->status == 'accepted'){
                AdminRoleUser::where([
                    'user_id' => $model->user_id
                ])->delete();
                $r = new AdminRoleUser();
                $r->user_id = $model->user_id;
                $r->role_id = 5;
                $r->save();
            }else{
                AdminRoleUser::where([
                    'user_id' => $model->user_id
                ])->delete();
                $r = new AdminRoleUser();
                $r->user_id = $model->user_id;
                $r->role_id = 3;
                $r->save();
            }
        });

    }


}
