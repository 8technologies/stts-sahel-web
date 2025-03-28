<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Auth\Database\Administrator;

class AgroDealers extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'agro_dealer_reg_number',
        'first_name',
        'last_name',
        'email',
        'category',
        'physical_address',
        'region',
        'department',
        'commune',
        'village',
        'shop_number',
        'company_name',
        'retailers_in',
        'business_registration_number',
        'years_in_operation',
        'business_description',
        'trading_license_number',
        'trading_license_period',
        'insuring authority',
        'attachments_certificate',
        'proof_of_payment'
        
    ];

    //update the role of the user on update
    public static function boot()
    {
        parent::boot();

        //call back to send a notification to the user
        self::created(function ($model) {
            Notification::send_notification($model, 'AgroDealers', request()->segment(count(request()->segments())));
        });


        self::updating(function ($model) {
          
        });

        self::updated(function ($model) {
            //call back to send a notification to the user after form is updated
            Notification::update_notification($model, 'AgroDealers', request()->segment(count(request()->segments()) - 1));

            //change the role of the basic user to that of an agro-dealer if approved
            if ($model->status == 'accepted') {
                AdminRoleUser::where([
                    'user_id' => $model->user_id
                ])->delete();
                $new_role = new AdminRoleUser();
                $new_role->user_id = $model->user_id;
                $new_role->role_id = 9;
                $new_role->save();
            }
        });
    }
}
