<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;
use OpenAdmin\Admin\Facades\Admin;
use OpenAdmin\Admin\Auth\Database\Administrator;
use App\Mail\MyNotification;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = 
    [
        'receiver_id',
        'role_id',
        'message',
        'form_link',
        'link',
        'status',
        'model',
        'model_id',
    ];

//relationship between notification and user
    public function receiver()
    {
        return $this->belongsTo(Administrator::class, 'receiver_id');
    }

//function to get notification and send it to the front end
public static function get_notifications($user)
    {
        if ($user == null) {
            return [];
        }

        $done_ids = [];
        $notifications = Notification::where('receiver_id', $user->id)
            ->orderBy('id', 'desc')
            ->get()
            ->unique('id')
            ->values();

        foreach ($notifications as $notification) {
            $done_ids[] = $notification->id;
        }

        foreach ($user->roles as $role) {
            $roleNotifications = Notification::where('role_id', $role->id)
                ->orderBy('id', 'desc')
                ->get()
                ->unique('id')
                ->values();

            foreach ($roleNotifications as $notification) {
                if (in_array($notification->id, $done_ids)) {
                    continue;
                }
                $done_ids[] = $notification->id;
                $notifications->push($notification);
            }
        }

        return $notifications;
    }
    
//function to send notifications after creation
    public static function send_notification($model, $model_name, $entity)
    {
        //check if $entity is a string
        if(is_string($entity))
        {
            $notification = new Notification();
            $notification->role_id = 2;
            $notification->message = Admin::user()->name. ' has applied for a {$entity} ';
            $notification->link = admin_url("auth/login"); 
            $notification->form_link = admin_url("{$entity}/{$model->id}");
            $notification->status = 'Unread'; 
            $notification->model = $model_name;
            $notification->model_id = $model->id; 
            $notification->save();

            self::sendMail($notification); 
        }

    }

//function to send notifications after an update
    public static function update_notification($model, $model_name, $entity)
    {
        $notifications = Notification::where('model', $model_name)
            ->where('model_id', $model->id)
            ->get();
        $notificationData = [
            2 => [
                'message' => "Dear {name}, you have been assigned to inspect {$entity}.",
                'receiver_id' => $model->inspector_id,
            ],
            3 => [
                'message' => "Dear {name}, your {$entity} is now under inspection.",
                'receiver_id' => $model->user_id,
            ],
            4 => [
                'message' => "Dear {name}, your {$entity} has been halted by the inspector.",
                'receiver_id' => $model->user_id,
            ],
            5 => [
                'message' => "Dear {name}, your {$entity} has been rejected by the inspector.",
                'receiver_id' => $model->user_id,
            ],
        ];

        foreach ($notifications as $notification) {
            $notification->delete();
        }

        foreach ($notificationData as $status => $data) {
            if ($model->status == $status) {
                $receiver = Administrator::find($data['receiver_id']);
                $message = str_replace('{name}', $receiver->name, $data['message']);

                $notification = new Notification();
                $notification->receiver_id = $receiver->id;
                $notification->message = $message;
                $notification->link = admin_url("auth/login");
                $notification->form_link = admin_url("{$entity}/{$model->id}");
                $notification->status = 'Unread';
                $notification->model = $model_name;
                $notification->model_id = $model->id;

                $notification->save();

                self::sendMail($notification);
            }
        }
    }

    
//get notification receipients by either role or id
    public static function get_users_by_role($role_id)
    {
        $admin= Administrator::whereHas('roles', function ($query) use ($role_id) {
            $query->where('admin_role_users.role_id', $role_id);
        })->get();

        return $admin;
    }

    public static function get_users_by_id($receiver_id)
    {
        $users= Administrator::with('notifications')
            ->where('id', $receiver_id)
            ->get();

            return $users;
    }
    
 //send an email notification
    public static function sendMail($notification)
    {
        if($notification->receiver_id != null)
        { 
            $receivers = self::get_users_by_id($notification->receiver_id);
                
        } else
        {
            $receivers = self::get_users_by_role($notification->role_id);
        }

        $emails = $receivers->pluck('email')->toArray();

        error_log($notification->link);
        Mail::to($emails)->send(new MyNotification($notification->message, $notification->link));
    }


}