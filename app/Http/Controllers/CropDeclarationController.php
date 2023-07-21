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

class CropDeclarationController extends Controller
{
    //
    public function crop_declarations_post(Request $r)
    {
        $u = auth('api')->user();
        $sp = SeedProducer::where('user_id', $u->id)->first();
        if ($sp == null) {
            return Utils::apiError('You need a valid Seed Producer Certiificate t apply for crop declaration.');
        }
        if ($sp->status != 'accepted') {
            return Utils::apiError('Your Seed Producer Application is not accepted yet.');
        }
        $cv = CropVariety::find($r->crop_variety_id);
        if ($cv == null) {
            return Utils::apiError('Invalid crop variety.');
        }

        $cd = new CropDeclaration();
        $cd->applicant_id = $u->id;
        $cd->seed_producer_id = $sp->id;
        $cd->phone_number = $r->phone_number;
        $cd->applicant_registration_number = $r->applicant_registration_number;
        $cd->garden_size = $r->garden_size;
        $cd->gps_coordinates_1 = $r->gps_coordinates_1;
        $cd->gps_coordinates_2 = $r->gps_coordinates_2;
        $cd->gps_coordinates_3 = $r->gps_coordinates_3;
        $cd->gps_coordinates_4 = $r->gps_coordinates_4;
        $cd->field_name = $r->field_name;
        $cd->district_region = $r->district_region;
        $cd->circle = $r->circle;
        $cd->township = $r->township;
        $cd->village = $r->village;
        $cd->planting_date = $r->planting_date;
        $cd->quantity_of_seed_planted = $r->quantity_of_seed_planted;
        $cd->expected_yield = $r->expected_yield;
        $cd->seed_supplier_name = $r->seed_supplier_name;
        $cd->seed_supplier_registration_number = $r->seed_supplier_registration_number;
        $cd->source_lot_number = $r->source_lot_number;
        $cd->origin_of_variety = $r->origin_of_variety;
        $cd->garden_location_latitude = $r->garden_location_latitude;
        $cd->garden_location_longitude = $r->garden_location_longitude;
        $cd->crop_variety_id = $r->crop_variety_id;

        try {
            $cd->save();
        } catch (\Throwable $th) {
            return Utils::apiError('Error saving form. ' . $th->getMessage());
        }
        return Utils::apiSuccess($sp, 'Crop Declaration form submitted successfully.');
    }

    public function crop_declarations()
    {
        $u = auth('api')->user();
        //return Utils::apiSuccess(CropDeclaration::where('applicant_id', $u->id)->get());
        return Utils::apiSuccess(CropDeclaration::where([])->get());
    }
}
