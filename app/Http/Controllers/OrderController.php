<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\Utils;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::all();
        return response()->json($orders);
    }

    public function store(Request $request)
    {
        $user = auth('api')->user();
        $data = $request->all();
        $order = Order::create($data);
        return Utils::apiSuccess($order, 'Order submitted successfully.');
    }

    public function show($id)
    {
        $order = Order::where('supplier', $id)->get();

        return response()->json($order);
    }

    public function showMyOrders($id)
    {
        $order = Order::where('order_by', $id)->get();
        
        return response()->json($order);
    }

    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $data = $request->all();
        $order->update($data);
        return Utils::apiSuccess($order, 'Order edited successfully.');
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
        return Utils::apiSuccess($order, 'Order deleted successfully.');
    }
}
