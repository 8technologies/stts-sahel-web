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
        $crops = Crop::all();
        return response()->json($crops);
    }


    public function crop_varieties()
    {
        $crop_varieties = CropVariety::all();
        return response()->json($crop_varieties);

    }
   
}
