<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cooperative;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\Utils;

class CooperativeController extends Controller
{
    public function index()
    {
        $cooperatives = Cooperative::all();
        return response()->json($cooperatives);
    }

    public function store(Request $request)
    {
        $user = auth('api')->user();
        $data = $request->all();
        $cooperative = Cooperative::create($data);
        return Utils::apiSuccess($cooperative, 'Cooperative submitted successfully.');
    }

    public function show($id)
    {
        $cooperative = Cooperative::where('user_id', $id)->firstOrFail();

        return response()->json($cooperative);
    }

    public function update(Request $request, $id)
    {
        $cooperative = Cooperative::where('user_id', $id)->firstOrFail();
        $data = $request->all();
        $cooperative->update($data);
        return Utils::apiSuccess($cooperative, 'Cooperative edited successfully.');
    }

    public function destroy($id)
    {
        $cooperative = Cooperative::where('user_id', $id)->firstOrFail();
        $cooperative->delete();
        return Utils::apiSuccess($cooperative, 'Cooperative deleted successfully.');
    }
}
