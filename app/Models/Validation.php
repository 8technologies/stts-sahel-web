<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Validation extends Model
{
    use HasFactory;

//check the form status before an inspector can edit
    public static function checkFormStatus($model, $id){
        $model = "App\\Models\\" .ucfirst($model);
        $form = $model::find($id);
        if ($form->status != 'inspector assigned' ) {
            return false;
        }else{
            return true;
        }
    }

//check the form status before an inspector can edit
    public static function checkFormUserStatus($model, $id)
    {
        $model = "App\\Models\\" .ucfirst($model);
        $form = $model::find($id);
        if ($form->status == 'accepted'|| $form->status == 'rejected'  ) {
            return false;
        }else{
            return true;
        }
    }

 //check the user before givig hi,e roghts to access the form
    public static function checkUser($model, $id)
    {
        $model = "App\\Models\\" .ucfirst($model);
        $form = $model::find($id);
        if($form->user_id != null)
        {
            if ($form->user_id != auth()->user()->id ) {
                return false;
            }else{
                return true;
            }
        }else
        {
            if ($form->applicant_id != auth()->user()->id ) 
            {
                return false;
            }else{
                return true;
            }
        }


    }
}
