<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OpenAdmin\Admin\Facades\Admin;
use App\Models\FieldInspection;


class CustomValidation extends Model
{
    use HasFactory;

    //function to check if the status of the seed producer form is accepted or not
    public static function validateFormStatus($model_name)
    {
        $model = "App\\Models\\" . ucfirst($model_name);
        $status = $model::where('user_id', Admin::user()->id)->value('status');
    
        return boolval($status == 5);
    }
    
    //function to check if the field inspection is active or not
    public static function validateFieldInspectionStatus($model_name, $model_id)
    {
        $model = "App\\Models\\" . ucfirst($model_name);
        $status = model::where('id',$model_id )->value('is_active');
    
        return boolval($status == 1);
    }

    //function to check if the last field inspection for a particular crop variety is done or not
    public static function validateCropDeclaration()
    {
        //get the field inspections belonging to the user, then check if foreach crop variety, all inspections are done
        $status = CropDeclaration::where('applicant_id', Admin::user()->id)->value('status');
        
        return boolval($status == 5);
       
    }
    
}
