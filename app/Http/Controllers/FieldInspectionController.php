<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FieldInspection;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\Utils;

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
}
