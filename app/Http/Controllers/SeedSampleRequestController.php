<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SeedLab;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\Utils;
use Illuminate\Support\Facades\Storage;


class SeedSampleRequestController extends Controller
{
    public function index()
    {
        $seedSamples = SeedLab::all();
        return response()->json($seedSamples);
    }

    public function store(Request $request)
    {
        $user = auth('api')->user();
        $data = $request->all();

        if ($request->has('proof_of_payment')) 
       {
            $photoData = $request->input('proof_of_payment');
            list($type, $photoData) = explode(';', $photoData);
            list(, $photoData) = explode(',', $photoData);
            $photoData = base64_decode($photoData);
        
            $photoPath = 'images/' . uniqid() . '.jpg'; 
            Storage::disk('admin')->put($photoPath, $photoData);
            
            $data['proof_of_payment'] = $photoPath;
        }

        $seedSample = SeedLab::create($data);
        return Utils::apiSuccess($seedSample, 'Seed Sample Request submitted successfully.');
    }

    public function show($id)
    {
        $seedSample = SeedLab::where('user_id' ,$id)->get();

        return response()->json($seedSample);
    }

    public function update(Request $request, $id)
    {
        $seedSample = SeedLab::findOrFail($id);

        $data = $request->all();

        if ($request->has('proof_of_payment')) 
        {
             $photoData = $request->input('proof_of_payment');
             list($type, $photoData) = explode(';', $photoData);
             list(, $photoData) = explode(',', $photoData);
             $photoData = base64_decode($photoData);
         
             $photoPath = 'images/' . uniqid() . '.jpg'; 
             Storage::disk('admin')->put($photoPath, $photoData);
             
             $data['proof_of_payment'] = $photoPath;
         }
        $seedSample->update($data);
        return Utils::apiSuccess($seedSample, 'Seed Sample Request edited successfully.');
    }

    public function destroy($id)
    {
        $seedSample = SeedLab::findOrFail($id);
        $seedSample->delete();
        return Utils::apiSuccess($seedSample, 'Seed Sample Request deleted successfully.');
    }

       //get the inspections assigned to an inspector
       public function getAssignedRequests($id)
       {
    
           $SeedLabs = SeedLab::where('inspector_id', $id)->get();
           return Utils::apiSuccess($SeedLabs);
       }
   
       //edit the inspections of an inspector
       public function updateAssignedRequests(Request $request, $id)
       {
           $SeedLab = SeedLab::find($id);
           // Check if the seed sample request exists
           if (!$SeedLab) {
               return Utils::apiError('seed sample request not found.', 404);
           }
   
           //get the authenticated user
           $user = auth('api')->user();
   
           //check if the user is an inspector and the inspector id is the same as the authenticated user
           if ($SeedLab->inspector_id != $user->id) {
               return Utils::apiError('You are not authorized to edit this seed sample request.', 403);
           }
   
           $data = $request->all();
           $SeedLab->update($data);
           return Utils::apiSuccess($SeedLab, 'seed sample request form edited successfully.');
       }
}
