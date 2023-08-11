<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AgroDealer;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\Utils;

class AgroDealerController extends Controller
{
    public function index()
    {
        $agroDealers = AgroDealer::all();
        return response()->json($agroDealers);
    }

    public function store(Request $request)
    {
        $user = auth('api')->user();
        $data = $request->all();
        $agroDealer = AgroDealer::create($data);
        return Utils::apiSuccess($agroDealer, 'Agro Dealer submitted successfully.');
    }

    public function show($id)
    {
        $agroDealer = AgroDealer::findOrFail($id);

        return response()->json($agroDealer);
    }

    public function update(Request $request, $id)
    {
        $agroDealer = AgroDealer::findOrFail($id);

        $data = $request->all();
        $agroDealer->update($data);
        return Utils::apiSuccess($agroDealer, 'Agro Dealer edited successfully.');
    }

    public function destroy($id)
    {
        $agroDealer = AgroDealer::findOrFail($id);
        $agroDealer->delete();
        return Utils::apiSuccess($agroDealer, 'Agro Dealer deleted successfully.');
    }
}
