<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SeedLab;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\Utils;

class SeedSampleRequestController extends Controller
{
    public function index()
    {
        $seedSamples = SeedLab::all();
        return response()->json($seedSamples);
    }

    public function store(Request $request)
    {
        $user = auth('api')->user();
        $data = $request->all();
        $seedSample = SeedLab::create($data);
        return Utils::apiSuccess($seedSample, 'Seed Sample Request submitted successfully.');
    }

    public function show($id)
    {
        $seedSample = SeedLab::findOrFail($id);

        return response()->json($seedSample);
    }

    public function update(Request $request, $id)
    {
        $seedSample = SeedLab::findOrFail($id);

        $data = $request->all();
        $seedSample->update($data);
        return Utils::apiSuccess($seedSample, 'Seed Sample Request edited successfully.');
    }

    public function destroy($id)
    {
        $seedSample = SeedLab::findOrFail($id);
        $seedSample->delete();
        return Utils::apiSuccess($seedSample, 'Seed Sample Request deleted successfully.');
    }
}
