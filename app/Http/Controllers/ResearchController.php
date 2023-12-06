<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Research;
use App\Models\Utils;
use Illuminate\Support\Facades\Storage;

class ResearchController extends Controller
{
    public function index()
    {
        $Researchs = Research::all();
        return response()->json($Researchs);
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

    
        $Research = Research::create($data);
        return Utils::apiSuccess($Research, 'Research form submitted successfully.');
    }
    

    public function show($id)
    {
        $Research = Research::where('user_id', $id)->firstOrFail();

        return response()->json($Research);
    }

    public function update(Request $request, $id)
    {
        $Research = Research::where('user_id', $id)->firstOrFail();

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
 
        $Research->update($data);
        return Utils::apiSuccess($Research, 'Research form edited successfully.');
    }

    public function destroy($id)
    {
        $Research = Research::where('user_id', $id)->firstOrFail();
        $Research->delete();
        return Utils::apiSuccess($Research, 'Research form deleted successfully.');
    }
}
