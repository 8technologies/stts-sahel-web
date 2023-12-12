<?php

namespace App\Http\Controllers;


use App\Models\SeedClass;

class SeedGenerationController extends Controller
{
    public function index()
    {
        $seed_generation = SeedClass::all();
        return response()->json($seed_generation);
    }
}
