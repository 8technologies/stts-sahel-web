<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Notification;

class NotificationController extends Controller
{
    public function show($id)
    {
        $notificatiions = Notification::where('receiver_id', $id)->get();

        //check if the logged in user is the receiver of the notification
        //get logged in user id
        $id = auth('api')->user()->id;

        foreach($notificatiions as $notification){
            if($notification->receiver_id != $id){
                return response()->json(['error' => 'You can only view your notifications.'], 403);
            }
        }
       
        return response()->json($notificatiions);
    }
}
