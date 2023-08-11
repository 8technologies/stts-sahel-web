<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AgroDealers;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\Utils;

class AgroDealerController extends Controller
{
    public function index()
    {
        $agroDealers = AgroDealers::all();
        return response()->json($agroDealers);
    }

    public function store(Request $request)
    {
        $user = auth('api')->user();
        $data = $request->all();
        $agroDealer = AgroDealers::create($data);
        return Utils::apiSuccess($agroDealer, 'Agro Dealer submitted successfully.');
    }

    public function show($id)
    {
        $agroDealer = AgroDealers::findOrFail($id);

        return response()->json($agroDealer);
    }

    public function update(Request $request, $id)
    {
        $agroDealer = AgroDealers::findOrFail($id);

        $data = $request->all();
        $agroDealer->update($data);
        return Utils::apiSuccess($agroDealer, 'Agro Dealer edited successfully.');
    }

    public function destroy($id)
    {
        $agroDealer = AgroDealers::findOrFail($id);
        $agroDealer->delete();
        return Utils::apiSuccess($agroDealer, 'Agro Dealer deleted successfully.');
    }
}
