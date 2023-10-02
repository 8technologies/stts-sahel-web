<?php

namespace App\Http\Controllers;

use App\Models\CropDeclaration;
use App\Models\CropVariety;
use Illuminate\Http\Request;
use App\Models\SeedProducer;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\Utils;

class CropDeclarationController extends Controller
{
    public function index()
    {
        $cropDeclarations = CropDeclaration::all();
        return response()->json($cropDeclarations);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $cropDeclaration = CropDeclaration::create($data);
        return Utils::apiSuccess($cropDeclaration, 'Crop Declaration  form submitted successfully.');
    }

    public function show($id)
    {
        $cropDeclaration = CropDeclaration::where('user_id', $id)->get();

        return response()->json($cropDeclaration);
    }

    public function update(Request $request, $id)
    {
        $cropDeclaration = CropDeclaration::find($id);

        $data = $request->all();
        $cropDeclaration->update($data);
        return Utils::apiSuccess($cropDeclaration, 'Crop Declaration form edited successfully.');
    }

    public function destroy($id)
    {
        $cropDeclaration = CropDeclaration::where('user_id', $id);
        $cropDeclaration->delete();
        return Utils::apiSuccess($cropDeclaration, 'Crop Declaration form deleted successfully.');
    }
}

