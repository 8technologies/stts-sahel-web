<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SeedProducer;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\Utils;
use Illuminate\Support\Facades\Storage;

class SeedProducerController extends Controller
{
    public function index()
    {
        $seedProducers = SeedProducer::all();
        return response()->json($seedProducers);
    }

    public function store(Request $request)
    {
        $user = auth('api')->user();
        $data = $request->all();
        
        // if ($request->hasFile('receipt')) 
        // {
        //     $imagePath = $request->file('receipt')->store('images', 'public');
        //     $data['receipt'] = $imagePath;
        // }

       // Store the uploaded photo
       if ($request->has('receipt')) 
       {
            $photoData = $request->input('receipt');
            list($type, $photoData) = explode(';', $photoData);
            list(, $photoData) = explode(',', $photoData);
            $photoData = base64_decode($photoData);
        
            $photoPath = 'images/' . uniqid() . '.jpg'; 
            Storage::disk('admin')->put($photoPath, $photoData);
            
            $data['receipt'] = $photoPath;
        }

    
        $seedProducer = SeedProducer::create($data);
        return Utils::apiSuccess($seedProducer, 'Seed Producer form submitted successfully.');
    }
    

    public function show($id)
    {
        $seedProducer = SeedProducer::where('user_id', $id)->firstOrFail();

        return response()->json($seedProducer);
    }

    public function update(Request $request, $id)
    {
        $seedProducer = SeedProducer::where('user_id', $id)->firstOrFail();

        $data = $request->all();

        if ($request->has('receipt')) 
        {
             $photoData = $request->input('receipt');
             list($type, $photoData) = explode(';', $photoData);
             list(, $photoData) = explode(',', $photoData);
             $photoData = base64_decode($photoData);
         
             $photoPath = 'images/' . uniqid() . '.jpg'; 
             Storage::disk('admin')->put($photoPath, $photoData);
             
             $data['receipt'] = $photoPath;
         }
 
        $seedProducer->update($data);
        return Utils::apiSuccess($seedProducer, 'Seed Producer form edited successfully.');
    }

    public function destroy($id)
    {
        $seedProducer = SeedProducer::where('user_id', $id)->firstOrFail();
        $seedProducer->delete();
        return Utils::apiSuccess($seedProducer, 'Seed Producer form deleted successfully.');
    }
}
