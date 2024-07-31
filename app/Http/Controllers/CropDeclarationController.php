<?php

namespace App\Http\Controllers;

use App\Models\CropDeclaration;
use App\Models\CropVariety;
use Illuminate\Http\Request;
use App\Models\SeedClass;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
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
        $rules = [
            'user_id' => 'required|exists:admins,id',
            'phone_number' => 'required',
            'garden_size' => 'required|numeric',
            'land_architecture' => 'required',
            'field_name' => 'required|unique:crop_declarations',
            'district_region' => 'required',
            'circle' => 'required',
            'township' => 'required',
            'village' => 'required',
            'planting_date' => 'required',
            'quantity_of_seed_planted' => 'required|numeric',
            'expected_yield' => 'required',
            'seed_supplier_name' => 'required',
            'seed_supplier_registration_number' => 'nullable',
            'source_lot_number' => 'required',
            'origin_of_variety' => 'required',
            'garden_location_latitude' => 'required',
            'garden_location_longitude' => 'required',
            'status' => 'nullable',
            'inspector_id' => 'nullable|exists:inspectors,id',
            'seed_class_id' => 'required|exists:seed_classes,id',
            'crop_variety_id' => 'required|exists:crop_varieties,id',
            'out_grower_id' => 'nullable|exists:out_growers,id',
            'status_comment' => 'nullable',
            'details' => 'nullable',
        ];
    
        try {
            // Validate the incoming request data
            $validatedData = Validator::make($request->all(), $rules)->validate();
            
            // Automatically set the 'mobile' field to 'yes'
            $validatedData['mobile'] = 'yes';
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        }
    
        $cropDeclaration = CropDeclaration::create($validatedData);
        return Utils::apiSuccess($cropDeclaration, 'Crop Declaration form submitted successfully.');
    }
    
    public function show($id)
    {
        $cropDeclaration = CropDeclaration::where('user_id', $id)->get();

        return response()->json($cropDeclaration);
    }

    public function update(Request $request, $id)
    {
        $cropDeclaration = CropDeclaration::find($id);

        $rules = [
            'user_id' => 'required|exists:admins,id',
            'phone_number' => 'required',
            'garden_size' => 'required|numeric',
            'land_architecture' => 'required',
            'field_name' => 'required|unique:crop_declarations',
            'district_region' => 'required',
            'circle' => 'required',
            'township' => 'required',
            'village' => 'required',
            'planting_date' => 'required',
            'quantity_of_seed_planted' => 'required|numeric',
            'expected_yield' => 'required',
            'seed_supplier_name' => 'required',
            'seed_supplier_registration_number' => 'nullable',
            'source_lot_number' => 'required',
            'origin_of_variety' => 'required',
            'garden_location_latitude' => 'required',
            'garden_location_longitude' => 'required',
            'status' => 'nullable',
            'inspector_id' => 'nullable|exists:inspectors,id',
            'seed_class_id' => 'required|exists:seed_classes,id',
            'crop_variety_id' => 'required|exists:crop_varieties,id',
            'out_grower_id' => 'nullable|exists:out_growers,id',
            'status_comment' => 'nullable',
            'details' => 'nullable',
        ];

        try {
            // Validate the incoming request data
            $validatedData = Validator::make($request->all(), $rules)->validate();
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        }

        $cropDeclaration->update($validatedData);
        return Utils::apiSuccess($cropDeclaration, 'Crop Declaration form edited successfully.');
    }

    public function destroy($id)
    {
        $cropDeclaration = CropDeclaration::where('user_id', $id);
        $cropDeclaration->delete();
        return Utils::apiSuccess($cropDeclaration, 'Crop Declaration form deleted successfully.');
    }

    public  function getAcceptedCropDeclarations($id)
    {
        $cropDeclaration = CropDeclaration::where('user_id', $id)->where('status', 'accepted')->get();

        $result = [];

        foreach($cropDeclaration as $crop){
            $cropVariety = CropVariety::find($crop->crop_variety_id)->crop_variety_name;
            $seed_class = SeedClass::find($crop->seed_class_id)->class_name;
            $result[] =[
                'crop_variety' => $cropVariety,
                'seed_class' => $seed_class,
                'crop_declaration' => $crop,

            ];
        }
        return response()->json($result);
    }
}

