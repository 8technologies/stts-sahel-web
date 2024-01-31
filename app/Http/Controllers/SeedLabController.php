<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SeedLab;
use App\Models\LoadStock;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\Utils;
use Illuminate\Support\Facades\Storage;

class SeedLabController extends Controller
{
    public function index()
    {
        $seedLabs = SeedLab::all();
        return response()->json($seedLabs);
    }

    public function store(Request $request)
    {
        $user = auth('api')->user();
        $data = $request->all();
        $seedLab = SeedLab::create($data);
        return Utils::apiSuccess($seedLab, 'Seed Lab Request submitted successfully.');
    }

    public function show($id)
    {
        $seedLab = SeedLab::where('user_id', '=', $id)->where('status', '=', 'lab test assigned')->get();

        return response()->json($seedLab);
    }

    public function showMarketableSeed($id)
    {
        $seedLab = SeedLab::where('user_id', '=', $id)->where('test_decision', '=', 'marketable')->get();
        $result = [];
        //for each get the seed class object
        foreach ($seedLab as $stock) {
            $load_stock = LoadStock::find($stock->load_stock_id);
            $result[] = [
                'seed_lab' => $stock,
                'load_stock' => $load_stock
            ];
        }
        return response()->json($result);
    }

    public function update(Request $request, $id)
    {
        $seedLab = SeedLab::findOrFail($id);

        $data = $request->all();

        if ($request->has('reporting_and_signature')) 
        {
             $photoData = $request->input('reporting_and_signature');
             list($type, $photoData) = explode(';', $photoData);
             list(, $photoData) = explode(',', $photoData);
             $photoData = base64_decode($photoData);
         
             $photoPath = 'images/' . uniqid() . '.jpg'; 
             Storage::disk('admin')->put($photoPath, $photoData);
             
             $data['reporting_and_signature'] = $photoPath;
         }

        $seedLab->update($data);
        return Utils::apiSuccess($seedLab, 'Seed Lab Request edited successfully.');
    }

    public function destroy($id)
    {
        $seedLab = SeedLab::findOrFail($id);
        $seedLab->delete();
        return Utils::apiSuccess($seedLab, 'Seed Lab Request deleted successfully.');
    }
}
