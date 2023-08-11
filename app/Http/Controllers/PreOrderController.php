<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PreOrder;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\Utils;

class PreOrderController extends Controller
{
    public function index()
    {
        $preOrders = PreOrder::all();
        return response()->json($preOrders);
    }

    public function store(Request $request)
    {
        $user = auth('api')->user();
        $data = $request->all();
        $preOrder = PreOrder::create($data);
        return Utils::apiSuccess($preOrder, 'PreOrder submitted successfully.');
    }

    public function show($id)
    {
        $preOrder = PreOrder::findOrFail($id);

        return response()->json($preOrder);
    }

    public function update(Request $request, $id)
    {
        $preOrder = PreOrder::findOrFail($id);

        $data = $request->all();
        $preOrder->update($data);
        return Utils::apiSuccess($preOrder, 'PreOrder edited successfully.');
    }

    public function destroy($id)
    {
        $preOrder = PreOrder::findOrFail($id);
        $preOrder->delete();
        return Utils::apiSuccess($preOrder, 'PreOrder deleted successfully.');
    }
}
