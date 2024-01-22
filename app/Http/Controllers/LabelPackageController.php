<?php

namespace App\Http\Controllers;

use App\Models\LabelPackage;
use Illuminate\Http\Request;

class LabelPackageController extends Controller
{
    //
    public function packages($id)
    {

        $packages = LabelPackage::where('seed_generation', $id)->get();
        return response()->json($packages);
    }

}
