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

class CropController extends Controller
{
    //
    
    
    public function crops()
    {
        return Utils::apiSuccess(Crop::where([])->get());
    }
    public function crop_varieties()
    {
        return Utils::apiSuccess(CropVariety::where([])->get());
    }
   
}
