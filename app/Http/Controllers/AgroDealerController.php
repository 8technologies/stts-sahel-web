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

        if ($request->hasFile('attachments_certificate')) {
            $imagePath = $request->file('attachments_certificate')->store('images', 'public');
            $data['attachments_certificate'] = $imagePath;
        }
        if ($request->hasFile('proof_of_payment')) {
            $imagePath = $request->file('proof_of_payment')->store('images', 'public');
            $data['proof_of_payment'] = $imagePath;
        }  

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
