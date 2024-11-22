<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Research extends Model
{

    use HasFactory;

    protected $casts = [
      'seed_generation' => 'array',
    ];

    protected $fillable = 
    [
       'user_id',
       'producer_registration_number',
       'seed_generation',
       'name_of_applicant',
       'applicant_phone_number',
       'applicant_email',
       'premises_location',
       'proposed_farm_location',
       'years_of_experience',
       'recommendation',
       'gardening_history_description',
       'storage_facilities_description',  
       'receipt',
       'status',
       'status_comment',
       'inspector_id',
       'grower_number',
       'valid_from',
       'valid_until',
    ];


   
   public static function boot()
    {
       parent::boot();

       //call back to send a notification to the user
       self::created(function ($model) 
       {
           Notification::send_notification($model, 'Research', request()->segment(count(request()->segments())));
       });


       self::updated(function ($model) 
       {
          //call back to send a notification to the user after form is updated
          Notification::update_notification($model, 'Research', request()->segment(count(request()->segments())-1));
           
          //change the role of the basic user to that of the seed producer if approved
          if($model->status == 'accepted')
            {
               AdminRoleUser::where([
                   'user_id' => $model->user_id
               ])->delete();
               $new_role = new AdminRoleUser();
               $new_role->user_id = $model->user_id;
               $new_role->role_id = 10;
               $new_role->save();
            }
       });


    }

}
