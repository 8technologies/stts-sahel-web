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

 //check the user before givig him roghts to access the form
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

    //Check the user role before allowing him to access the form
    public static function checkUserRole()
    {
        //get authenticated user role
        $user = auth()->user();
        if($user != null)
        {
            if (!$user->isRole('inspector')) {
                return false;
            }else{
                return true;
            }
        }
      
    }

    
//check the form status before an inspector can edit
public static function checkInspectionStatus($model, $id)
{
    $model = "App\\Models\\" .ucfirst($model);
    $form = $model::find($id);
    if ($form->field_decision == 'accepted'|| $form->field_decision == 'rejected'  ) {
        return false;
    }else{
        return true;
    }
}


//check if the form is editable by the user
public static function checkFormEditable($form, $id)
{
    $user = auth()->user();
    if($user->inRoles(['basic-user', 'cooperative'])){
        //check if the user is the owner of the form
           $editable = Validation::checkUser('Cooperative', $id);
           if(!$editable){
              $form->html(' <p class="alert alert-warning">You do not have rights to edit this form. <a href="/admin/cooperatives"> Go Back </a></p> ');
              $form->footer(function ($footer) 
              {

                  // disable reset btn
                  $footer->disableReset();

                  // disable submit btn
                  $footer->disableSubmit();
             });
           }
           //check if the form has been accepted
           $editable_status = Validation::checkFormUserStatus('Cooperative', $id);
             if(!$editable_status){
              $form->html(' <p class="alert alert-warning">You can nolonger edit this form because a decision has already been made. <a href="/admin/cooperatives"> Go Back </a></p> ');
              $form->footer(function ($footer) 
              {

                    // disable reset btn
                    $footer->disableReset();

                    // disable submit btn
                    $footer->disableSubmit();
             });
             }
       }
       elseif($user->isRole('inspector')){
           $editable = Validation::checkFormStatus('Cooperative', $id);
           
           if(!$editable){

          
               $form->html(' <p class="alert alert-warning">You do not have rights to edit this form again. <a href="/admin/cooperatives"> Go Back </a></p> ');
               $form->footer(function ($footer) 
            {

                // disable reset btn
                $footer->disableReset();

                // disable submit btn
                $footer->disableSubmit();
           });
       }
       
   }
}

//show the logged in user, only the forms that belong to him
public static function showUserForms($grid)
{
    // show inspector what has been assigned to him
    if (auth('admin')->user()->isRole('inspector')) {
        $grid->model()->where('inspector_id', auth('admin')->user()->id);
    }

    //show the user only his records
    if (auth('admin')->user()->isRole('basic-user')) {
        $grid->model()->where('user_id', auth('admin')->user()->id);
    }

    //show the cooperative only his records
    if (auth('admin')->user()->isRole('cooperative')) {
        $grid->model()->where('user_id', auth('admin')->user()->id);
    }

    //show the seed producer only his records
    if (auth('admin')->user()->isRole('grower')) {
        $grid->model()->where('user_id', auth('admin')->user()->id);

    }
}
}
