<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MarketableSeed;
use App\Models\SeedLab;
use App\Models\LoadStock;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\Utils;

class MarketableSeedController extends Controller
{
    public function index()
    {
        $marketableSeeds = MarketableSeed::all();
        return response()->json($marketableSeeds);
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
        $marketableSeed = MarketableSeed::where('user_id', '=', $id)->where('status', '=', 'lab test assigned')->get();
        $result = [];
        //for each get the seed class object
        foreach ($marketableSeed as $stock) {
            $load_stock = LoadStock::find($stock->load_stock_id);
            $seed_lab = SeedLab::find($stock->seed_lab_id);
            $result[] = [
                'marketable_seed_id' => $stock->id,
                'load_stock' => $load_stock,
                'seed_lab' => $seed_lab
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
