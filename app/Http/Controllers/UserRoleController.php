<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdminRoleUser;

class UserRoleController extends Controller
{
    
    public function show($id)
    {
        $user_roles = AdminRoleUser::where('user_id', $id)->get();

        //check if the logged in user is the receiver of the notification
        //get logged in user id
        $id = auth('api')->user()->id;

        foreach($user_roles as $user_role){
            if($user_role->user_id != $id){
                return response()->json(['error' => 'You can only view your roles.'], 403);
            }
        }
       
        return response()->json($user_roles);
    }
}
