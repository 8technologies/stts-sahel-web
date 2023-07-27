<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CooperativeMember;
use Encore\Admin\Facades\Admin;

class Cooperative extends Model
{
    use HasFactory;

    protected $fillable = [
        'cooperative_number',
        'user_id',
        'cooperative_name',
        'registration_number',
        'cooperative_physical_address',
        'contact_person_name',
        'contact_phone_number',
        'contact_email',
        'membership_type',
        'services_to_members',
        'objectives_or_goals',
        'status',
        'inspector_id',
        'status_comment'
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
            if (Admin::user()->isRole('basic-user')) {
                $model->status = 'pending';
                $model->inspector_id = null;
                return $model;
            }
        });

        self::updated(function ($model) {
            //call back to send a notification to the user after form is updated
            Notification::update_notification($model, 'Cooperative', request()->segment(count(request()->segments()) - 1));

            //change the role of the basic user to that of the seed producer if approved
            if ($model->status == 'accepted') {
                AdminRoleUser::where([
                    'user_id' => $model->user_id
                ])->delete();
                $new_role = new AdminRoleUser();
                $new_role->user_id = $model->user_id;
                $new_role->role_id = 8;
                $new_role->save();
            }
        });
    }
}
