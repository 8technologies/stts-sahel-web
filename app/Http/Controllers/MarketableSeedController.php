<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MarketableSeed;
use App\Models\SeedLab;
use App\Models\LoadStock;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\Utils;
use App\Models\User;

class MarketableSeedController extends Controller
{
    public function index()
    {
        $marketableSeeds = MarketableSeed::all();
    
        $result = [];
        // For each marketable seed, get the load stock and seed lab objects
        foreach ($marketableSeeds as $stock) {
            $load_stock = LoadStock::find($stock->load_stock_id);
            $seed_lab = SeedLab::find($stock->seed_lab_id);
            $user = User::find($stock->user_id);
            $result[] = [
                'marketable_seed_id' => $stock->id,
                'load_stock' => $load_stock,
                'seed_lab' => $seed_lab,
                'user' => $user
            ];
        }
    
        return response()->json($result);
    }

    public function store(Request $request)
    {
        $user = auth('api')->user();
        $data = $request->all();
        $marketableSeed = MarketableSeed::create($data);
        return Utils::apiSuccess($marketableSeed, 'Marketable Seed submitted successfully.');
    }

    public function show($id)
    {
        $marketableSeed = MarketableSeed::where('user_id', '!=', $id)->get();
        $result = [];
        //for each get the seed class object
        foreach ($marketableSeed as $stock) {
            $load_stock = LoadStock::find($stock->load_stock_id);
            $seed_lab = SeedLab::find($stock->seed_lab_id);
            $user = User::find($stock->user_id);
            $result[] = [
                'marketable_seed_id' => $stock->id,
                'load_stock' => $load_stock,
                'seed_lab' => $seed_lab,
                'user' => $user
            ];
        }
        return response()->json($result);
    }

    public function update(Request $request, $id)
    {
        $marketableSeed = MarketableSeed::findOrFail($id);

        $data = $request->all();
        $marketableSeed->update($data);
        return Utils::apiSuccess($marketableSeed, 'Marketable Seed edited successfully.');
    }

    public function destroy($id)
    {
        $marketableSeed = MarketableSeed::findOrFail($id);
        $marketableSeed->delete();
        return Utils::apiSuccess($marketableSeed, 'Marketable Seed deleted successfully.');
    }
}
