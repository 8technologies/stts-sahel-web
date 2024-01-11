<?php

namespace App\Http\Controllers;

use App\Models\Crop;
use App\Models\CropDeclaration;
use App\Models\CropVariety;
use Illuminate\Http\Request;
use App\Models\FieldInspection;
use App\Models\InspectionType;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\Utils;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;

class  FieldInspectionController extends Controller
{
    public function index()
    {
        $fieldInspections = FieldInspection::all();
        return response()->json($fieldInspections);
    }

    public function store(Request $request)
    {
        $user = auth('api')->user();
        $data = $request->all();
        $fieldInspection = FieldInspection::create($data);
        return Utils::apiSuccess($fieldInspection, 'Field inspection form submitted successfully.');
    }

    public function show($id)
    {
        $fieldInspection = FieldInspection::where('user_id', $id)->get();

        return response()->json($fieldInspection);
    }

    public function update(Request $request, $id)
    {
        $fieldInspection = FieldInspection::find($id);
        // Check if the field inspection exists
        if (!$fieldInspection) {
            return Utils::apiError('Field inspection not found.', 404);
        }
        $data = $request->all();
        $fieldInspection->update($data);
        return Utils::apiSuccess($fieldInspection, 'Field inspection form edited successfully.');
    }

    public function destroy($id)
    {
        $fieldInspection = FieldInspection::find($id);
        $fieldInspection->delete();
        return Utils::apiSuccess($fieldInspection, 'Field inspection form deleted successfully.');
    }

    //get the inspections assigned to an inspector
    public function getAssignedInspections($id)
{
    $fieldInspections = FieldInspection::where('inspector_id', $id)->get();

    $result = [];

    foreach ($fieldInspections as $inspection) {
        $user = User::find($inspection->user_id)->name;
        $fieldInspectionType = InspectionType::find($inspection->inspection_type_id)->inspection_type_name;
        $cropDeclaration = CropDeclaration::find($inspection->crop_declaration_id);
        $crop_variety_id = $cropDeclaration->crop_variety_id;
        $crop_variety = CropVariety::find($crop_variety_id)->crop_variety_name;

        $result[] = [
            'fieldInspection' => $inspection,
            'user' => $user,
            'cropVariety' => $crop_variety,
            'fieldInspectionType' => $fieldInspectionType,
            'cropDeclaration' => $cropDeclaration,
        ];
    }

    return Utils::apiSuccess($result);
}


    //edit the inspections of an inspector
    public function updateAssignedInspections(Request $request, $id)
    {
        $fieldInspection = FieldInspection::find($id);
       
        // Check if the field inspection exists
        if (!$fieldInspection) {
            return Utils::apiError('Field inspection not found.', 404);
        }

        $data = $request->all();
        if ($request->has('signature')) 
        {
             $photoData = $request->input('signature');
             list($type, $photoData) = explode(';', $photoData);
             list(, $photoData) = explode(',', $photoData);
             $photoData = base64_decode($photoData);
         
             $photoPath = 'images/' . uniqid() . '.jpg'; 
             Storage::disk('admin')->put($photoPath, $photoData);
             
             $data['signature'] = $photoPath;
         }
        $fieldInspection->update($data);
        return Utils::apiSuccess($fieldInspection, 'Field inspection form edited successfully.');
    }
}
