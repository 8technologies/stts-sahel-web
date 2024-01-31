<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MarketableSeed;
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
        $marketableSeed = MarketableSeed::where('user_id', '!=', $id)->get();

        return response()->json('marketableSeed');
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
