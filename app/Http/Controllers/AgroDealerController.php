<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AgroDealers;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\Utils;
use Illuminate\Support\Facades\Storage;

class AgroDealerController extends Controller
{
    public function index()
    {
        $agroDealers = AgroDealers::all();
        return response()->json($agroDealers);
    }

    public function store(Request $request)
    {
        $user = auth('api')->user();
        $data = $request->all();


        if ($request->has('attachments_certificate'))
        {
            $photoData = $request->input('attachments_certificate');
             list($type, $photoData) = explode(';', $photoData);
             list(, $photoData) = explode(',', $photoData);
             $photoData = base64_decode($photoData);
         
             $photoPath = 'images/' . uniqid() . '.jpg'; 
             Storage::disk('admin')->put($photoPath, $photoData);
            
             $data['attachments_certificate'] = $photoPath;
        }


        $agroDealer = AgroDealers::create($data);
        return Utils::apiSuccess($agroDealer, 'Agro Dealer submitted successfully.');
    }

    public function show($id)
    {
        $agroDealer = AgroDealers::where('user_id', $id)->firstOrFail();

        return response()->json($agroDealer);
    }

    public function update(Request $request, $id)
    {
        $agroDealer = AgroDealers::where('user_id', $id)->firstOrFail();
        $data = $request->all();
    
        
        if ($request->has('attachments_certificate'))
        {
            $photoData = $request->input('attachments_certificate');
             list($type, $photoData) = explode(';', $photoData);
             list(, $photoData) = explode(',', $photoData);
             $photoData = base64_decode($photoData);
         
             $photoPath = 'images/' . uniqid() . '.jpg'; 
             Storage::disk('admin')->put($photoPath, $photoData);
            
             $data['attachments_certificate'] = $photoPath;
        }
    
        $agroDealer->update($data);
        return Utils::apiSuccess($agroDealer, 'Agro Dealer edited successfully.');
    }
    
    public function destroy($id)
    {
        $agroDealer = AgroDealers::where('user_id', $id)->firstOrFail();
        $agroDealer->delete();
        return Utils::apiSuccess($agroDealer, 'Agro Dealer deleted successfully.');
    }
}
