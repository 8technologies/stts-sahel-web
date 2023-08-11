<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quotation;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\Utils;

class QuotationController extends Controller
{
    public function index()
    {
        $quotations = Quotation::all();
        return response()->json($quotations);
    }

    public function store(Request $request)
    {
        $user = auth('api')->user();
        $data = $request->all();
        $quotation = Quotation::create($data);
        return Utils::apiSuccess($quotation, 'Quotation submitted successfully.');
    }

    public function show($id)
    {
        $quotation = Quotation::findOrFail($id);

        return response()->json($quotation);
    }

    public function update(Request $request, $id)
    {
        $quotation = Quotation::findOrFail($id);

        $data = $request->all();
        $quotation->update($data);
        return Utils::apiSuccess($quotation, 'Quotation edited successfully.');
    }

    public function destroy($id)
    {
        $quotation = Quotation::findOrFail($id);
        $quotation->delete();
        return Utils::apiSuccess($quotation, 'Quotation deleted successfully.');
    }
}
