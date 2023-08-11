<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SeedLab;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\Utils;

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
        $seedLab = SeedLab::findOrFail($id);

        return response()->json($seedLab);
    }

    public function update(Request $request, $id)
    {
        $seedLab = SeedLab::findOrFail($id);

        $data = $request->all();
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
