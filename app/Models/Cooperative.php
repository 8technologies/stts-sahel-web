<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CooperativeMember;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Auth\Database\Administrator;

class Cooperative extends Model
{
    use HasFactory;
    protected $casts = [
        'seed_generation' => 'array',
    ];

    protected $fillable = [
        'cooperative_number',
        'seed_generation',
        'date_of_creation',
        'user_id',
        'cooperative_name',
        'registration_number',
        'cooperative_physical_address',
        'contact_person_name',
        'contact_phone_number',
        'contact_email',
        'proof_of_payment',
        'status',
        // 'recommendation',
        // // 'inspector_id',
        // 'status_comment',
        // 'valid_from',
        // 'valid_until',
    ];

    //relatinship with coperative members
    public function members()
    {
        return $this->hasMany(CooperativeMember::class);
    }
    public static function boot()
    {
        parent::boot();

        //call back to send a notification to the user
        self::created(function ($model) {
            Notification::send_notification($model, 'Cooperative', request()->segment(count(request()->segments())));
        });


        self::updating(function ($model) {
           
        });

        self::updated(function ($model) {
            //call back to send a notification to the user after form is updated
            Notification::update_notification($model, 'Cooperative', request()->segment(count(request()->segments()) - 1));

            //change the role of the basic user to that of the seed producer if approved
            AdminRoleUser::where([
                'user_id' => $model->user_id,
                'role_id' => 3
            ])->delete();

            if ($model->status == 'accepted') {
                $existingRole = AdminRoleUser::where([
                    'user_id' => $model->user_id,
                    'role_id' => 8
                ])->first();
                // If the user doesn't have the agro-dealer role, add it
                if (!$existingRole) {
                    $new_role = new AdminRoleUser();
                    $new_role->user_id = $model->user_id;
                    $new_role->role_id = 8; // Role ID for agro-dealer
                    $new_role->save();
                }
                
            }
        });
    }
}
