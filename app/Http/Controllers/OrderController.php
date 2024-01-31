<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\CropVariety;
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
        $orders = Order::where('supplier', $id)->get();

        $result = [];
    
        // For each order, get the crop variety name
        foreach ($orders as $key => $value) {
            $crop_variety = CropVariety::where('id', $value->crop_variety)->first(); // Assuming you want a single result
            $result[] = [
                'crop_variety' => $crop_variety->crop_variety_name,
                'order' => $value
            ];
        }
    
        return response()->json($result);
    }

    public function showMyOrders($id)
    {
        $orders = Order::where('order_by', $id)->get();
        $result = [];
    
        // For each order, get the crop variety name
        foreach ($orders as $key => $value) {
            $crop_variety = CropVariety::where('id', $value->crop_variety)->first(); // Assuming you want a single result
            $result[] = [
                'crop_variety' => $crop_variety->crop_variety_name,
                'order' => $value
            ];
        }
    
        return response()->json($result);
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
