<?php
namespace App\Http\Controllers;

use App\Models\AdminRoleUser;
use App\Models\Crop;
use App\Models\CropDeclaration;
use App\Models\CropVariety;
use App\Models\FieldInspection;
use App\Models\SeedProducer;
use App\Models\User;
use App\Models\Utils;
use Dflydev\DotAccessData\Util;
use DragonCode\Contracts\Cashier\Auth\Auth;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
class SeedProducerController extends Controller
{
    //
    public function seed_producer_forms_post(Request $r)
    {
        $u = auth('api')->user();
        $sp = SeedProducer::where('user_id', $u->id)->first();
        if ($sp == null) {
            $sp = new SeedProducer();
            $sp->user_id = $u->id;
        }
        $sp->name_of_applicant = $r->name_of_applicant;
        $sp->producer_category = $r->producer_category;
        $sp->applicant_phone_number = $r->applicant_phone_number;
        $sp->applicant_email = $r->applicant_email;
        $sp->premises_location = $r->premises_location;
        $sp->proposed_farm_location = $r->proposed_farm_location;
        // $sp->premises_size = $r->premises_size;
        $sp->years_of_experience = $r->years_of_experience;
        $sp->gardening_history_description = $r->gardening_history_description;
        $sp->storage_facilities_description = $r->storage_facilities_description;
        $sp->have_adequate_isolation = $r->have_adequate_isolation;
        $sp->labor_details = $r->labor_details;
        $sp->receipt = $r->receipt; //file
        $sp->status_comment = $r->status_comment;
        try {
            $sp->save();
        } catch (\Throwable $th) {
            return Utils::apiError('Error saving form. ' . $th->getMessage());
        }
        return Utils::apiSuccess($sp, 'Seed Producer form submitted successfully.');
    }

    public function seed_producer_forms()
    {
        $u = auth('api')->user();
        //return Utils::apiSuccess(SeedProducer::where(['user_id', $u->id])->get());
        return Utils::apiSuccess(SeedProducer::where([])->get());
    }

   
}
