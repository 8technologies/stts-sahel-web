<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SeedLab;
use App\Models\LoadStock;
use App\Models\User;
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
           $result = [];
           //get the user name for each seed sample request
              foreach ($SeedLabs as $SeedLab) 
              {
                $user = User::find($SeedLab->user_id);
                $SeedLab->user_name = $user->name;
                $loadStock = LoadStock::where('id', $SeedLab->load_stock_id)->first();

                $result[] = [
                    'seedLab' => $SeedLab,
                    'user' => $user,
                    'loadStock' => $loadStock,
                ];
              }
           return Utils::apiSuccess($result);
       }
   
       //edit the inspections of an inspector
       public function updateAssignedRequests(Request $request, $id)
       {
           $SeedLab = SeedLab::find($id);
           // Check if the seed sample request exists
           if (!$SeedLab) {
               return Utils::apiError('seed sample request not found.', 404);
           }
   
           $data = $request->all();

           //check the status of the seed sample request
            if ($SeedLab->status == 'lab test assigned') {
                //if its approved, then update the load stock table quantity column with the quantity of the seed sample request
                $loadStock = LoadStock::where('id', $SeedLab->load_stock_id)->first();
                $loadStock->yield_quantity = $data['validated_stock'];
                $loadStock->save();

              }
           $SeedLab->update($data);
           return Utils::apiSuccess($SeedLab, 'seed sample request form edited successfully.');
       }
}
