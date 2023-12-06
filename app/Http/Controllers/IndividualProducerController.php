<?php

namespace App\Http\Controllers;

use App\Models\IndividualProducer;
use Illuminate\Http\Request;
use App\Models\Utils;
use Illuminate\Support\Facades\Storage;


class IndividualProducerController extends Controller
{
    public function index()
    {
        $IndividualProducers = IndividualProducer::all();
        return response()->json($IndividualProducers);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        
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

    
        $IndividualProducer = IndividualProducer::create($data);
        return Utils::apiSuccess($IndividualProducer, 'Individual Producer form submitted successfully.');
    }
    

    public function show($id)
    {
        $IndividualProducer = IndividualProducer::where('user_id', $id)->firstOrFail();

        return response()->json($IndividualProducer);
    }

    public function update(Request $request, $id)
    {
        $IndividualProducer = IndividualProducer::where('user_id', $id)->firstOrFail();

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
 
        $IndividualProducer->update($data);
        return Utils::apiSuccess($IndividualProducer, 'Individual Producer form edited successfully.');
    }

    public function destroy($id)
    {
        $IndividualProducer = IndividualProducer::where('user_id', $id)->firstOrFail();
        $IndividualProducer->delete();
        return Utils::apiSuccess($IndividualProducer, 'Individual Producer form deleted successfully.');
    }
}
