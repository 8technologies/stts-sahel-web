<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AgroDealers;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\Utils;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AgroDealerController extends Controller
{
    public function index()
    {
        $agroDealers = AgroDealers::all();
        return response()->json($agroDealers);
    }

    public function store(Request $request)
    {
       
        $rules = [
            'user_id' => 'required|exists:admin_users,id',
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

        if ($request->has('attachments_certificate'))
        {
            $photoData = $request->input('attachments_certificate');
             list($type, $photoData) = explode(';', $photoData);
             list(, $photoData) = explode(',', $photoData);
             $photoData = base64_decode($photoData);
         
             $photoPath = 'images/' . uniqid() . '.jpg'; 
             Storage::disk('admin')->put($photoPath, $photoData);
            
             $validatedData['attachments_certificate'] = $photoPath;
        }


        $agroDealer = AgroDealers::create($validatedData);
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
