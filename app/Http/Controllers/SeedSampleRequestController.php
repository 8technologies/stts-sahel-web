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
}
