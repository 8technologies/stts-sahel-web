<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Auth\Database\Administrator;
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
        if ($user == null) 
        {
            return [];
        }

        $done_ids = [];
        $notifications = Notification::where('receiver_id', $user->id)
            ->orderBy('id', 'desc')
            ->get()
            ->unique('id')
            ->values();

        foreach ($notifications as $notification) 
        {
            $done_ids[] = $notification->id;
        }

        foreach ($user->roles as $role) 
        {
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
        $name = User::find($model->user_id)->name;

        //check if $entity is a string
        if(is_string($entity))
        {
            $notification = new Notification();
            $notification->role_id = 1;
            $notification->message = "Nouveau {$entity} a été soumis par " . $name .' ';
            $notification->link = admin_url("auth/login");
            $notification->form_link = admin_url("{$entity}/{$model->id}/edit");
            $notification->status = 'Non lu';
            $notification->model = $model_name;
            $notification->model_id = $model->id;
            $notification->save();
        
            self::sendMail($notification);
        }

    }

     //function to send notifications after creation of quotation
     public static function quotation_notification($model, $model_name, $entity)
     {
         $name = User::find($model->quotation_by)->name;
 
         //check if $entity is a string
         if(is_string($entity))
         {
             $notification = new Notification();
             $notification->receiver_id = $model->quotation_to;
             $notification->message = "Nouveau {$entity} a été soumis par " . $name .' ';
             $notification->link = admin_url("auth/login");
             $notification->form_link = admin_url("{$entity}/{$model->id}/edit");
             $notification->status = 'Non lu';
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
        
        $name = Administrator::find($model->user_id)->name ?? Administrator::find($model->quotation_by)->name;
        $receiver_id = $model->quotation_by ? $model->quotation_by : $model->user_id;

        $notificationData = 
        [
            'inspector assigned' => [
                'message_inspector' => "Vous avez été désigné pour inspecter {$entity}.",
                'message' => "Cher {$name}, votre {$entity} est désormais attribué à un inspecteur.",
                'receiver_inspector_id' => $model->inspector_id,
                'receiver_id' => $model->user_id,
                'form_link' => admin_url("{$entity}/{$model->id}"),
                'inspector_form_link' => admin_url("{$entity}/{$model->id}"),
            ],
            'pending' => [
                'message' => "Cher {$name}, votre {$entity} est désormais en attente.",
                'receiver_id' => $receiver_id,
                'form_link' => admin_url("{$entity}/{$model->id}"),
            ],
            'halted' => [
                'message' => "Cher {$name}, votre {$entity} a été suspendu par l'inspecteur.",
                'receiver_id' => $receiver_id,
                'form_link' => admin_url("{$entity}/{$model->id}"),
            ],
            'rejected' => [
                'message' => "Cher {$name}, votre {$entity} a été rejeté par l'inspecteur.",
                'receiver_id' => $receiver_id,
                'form_link' => admin_url("{$entity}/{$model->id}"),
            ],
            'accepted' => [
                'message' => "Cher {$name}, votre {$entity} a été accepté par l'inspecteur.",
                'receiver_id' => $receiver_id,
                'form_link' => admin_url("{$entity}/{$model->id}"),
            ],
            'printed' => [
                'message' => "Cher {$name}, vos étiquettes de semences ont été imprimées par l'inspecteur.",
                'receiver_id' => $receiver_id,
                'form_link' => admin_url("seed-labels/{$model->id}"),
            ],
            'lab test assigned' => [
                'message' => "Cher {$name}, votre {$entity} a été assigné au technicien de laboratoire.",
                'receiver_id' => $model->user_id,
                'form_link' => admin_url("{$entity}/{$model->id}"),
            ],
            'recommended' => [
                'message' => "Le formulaire de {$name} a été recommandé par l'inspecteur.",
                'role_id' => 2,
                'receiver_id' => null,
                'form_link' => admin_url("{$entity}/{$model->id}"),
            ],
            
            'marketable' => [
                'message' => "Cher {$name}, votre {$entity} a été testé et est commercialisable.",
                'receiver_id' => $receiver_id,
                'form_link' => admin_url("{$entity}/{$model->id}"),
            ],

            'not marketable' => [
                'message' => "Cher {$name}, votre {$entity} a été testé et n'est pas commercialisable.",
                'receiver_id' => $receiver_id,
                'form_link' => admin_url("{$entity}/{$model->id}"),
            ],
        ];
        

        foreach ($notifications as $notification) 
        {
            $notification->delete();
        }

        foreach ($notificationData as $status => $data) 
        {
            if ($model->status == $status) {
                if ($status == 'inspector assigned') {
                    $receiver_inspector = Administrator::find($data['receiver_inspector_id']);
                    $message_inspector = str_replace('{name}', $receiver_inspector->name, $data['message_inspector']);

                    $notification_inspector = new Notification();
                    $notification_inspector->receiver_id = $receiver_inspector->id;
                    $notification_inspector->message = $message_inspector;
                    $notification_inspector->link = admin_url("auth/login");
                    $notification_inspector->form_link = $data['inspector_form_link'];
                    $notification_inspector->status = 'Unread';
                    $notification_inspector->model = $model_name;
                    $notification_inspector->model_id = $model->id;
                    $notification_inspector->save();

                   self::sendMail($notification_inspector);
                }

                if($data['receiver_id'] != null){
                    $receiver = Administrator::find($data['receiver_id']);
                    $message = str_replace('{name}', $receiver->name, $data['message']);
                    } else {
                        $receiver = null;
                        $message = $data['message'];
                    }

                $notification_user = new Notification();
                $notification_user->receiver_id = $receiver->id ?? null;
                $notification_user->role_id = $data['role_id'] ?? null;
                $notification_user->message = $message;
                $notification_user->link = admin_url("auth/login");
                $notification_user->form_link = $data['form_link'];
                $notification_user->status = 'Unread';
                $notification_user->model = $model_name;
                $notification_user->model_id = $model->id;
                $notification_user->save();

               self::sendMail($notification_user);
            }
        }
    }


    //function to send a notification of order
    public static function order_notification($model, $model_name, $entity)
    {
        $notifications = Notification::where('model', $model_name)
            ->where('model_id', $model->id)
            ->get();
        
        $name = Administrator::find($model->order_by)->name;
        $receiver_id =  $model->order_by;

        $notificationData = 
        [
            'pending' => [
                'message' => "Une nouvelle commande a été passée par " . $name .' ',
                'receiver_id' => $model->supplier,
                'form_link' => admin_url("{$entity}/{$model->id}"),
            ],
            'processing' => [
                'message' => "Cher {$name}, votre {$entity} est en cours de traitement.",
                'receiver_id' => $receiver_id,
                'form_link' => admin_url("{$entity}/{$model->id}"),
            ],
            'shipping' => [
                'message' => "Cher {$name}, votre {$entity} est en cours d'expédition.",
                'receiver_id' => $receiver_id,
                'form_link' => admin_url("{$entity}/{$model->id}"),
            ],
            'delivered' => [
                'message' => "Cher {$name}, votre {$entity} a été livré.",
                'receiver_id' => $receiver_id,
                'form_link' => admin_url("{$entity}/{$model->id}"),
            ],
            'cancelled' => [
                'message' => "Cher {$name}, votre {$entity} a été annulé.",
                'receiver_id' => $receiver_id,
                'form_link' => admin_url("{$entity}/{$model->id}"),
            ],
        ];
        

        foreach ($notifications as $notification) {
            $notification->delete();
        }

        foreach ($notificationData as $status => $data) {
            if ($model->status == $status) {
                $receiver = Administrator::find($data['receiver_id']);
                $message = str_replace('{name}', $receiver->name, $data['message']);
                $link = $data['form_link'];

                $notification = new Notification();
                $notification->receiver_id = $receiver->id;
                $notification->message = $message;
                $notification->link = admin_url("auth/login");
                $notification->form_link = $link;
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
        if ($notification->receiver_id != null) {
            $receivers = self::get_users_by_id($notification->receiver_id);
        } else {
            $receivers = self::get_users_by_role($notification->role_id);
        }

        if ($receivers->isEmpty()) {
            return "No receivers found."; // Return an error message
        }

        $emails = $receivers->pluck('email')->toArray();

        try {
            Mail::to($emails)->send(new MyNotification($notification->message, $notification->link));
        } catch (\Exception $e) {
            // Handle the exception (e.g., log the error or send another notification)
            return "Email sending failed: " . $e->getMessage();
        }

        return "Email sent successfully.";
    }
        


}