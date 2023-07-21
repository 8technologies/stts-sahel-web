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

class FieldInspectionController extends Controller
{
    //
    public function field_inspections()
    {
        $u = auth('api')->user();
        //return Utils::apiSuccess(FieldInspection::where('applicant_id', $u->id)->get());
        return Utils::apiSuccess(FieldInspection::where([])->get());
    }
}
