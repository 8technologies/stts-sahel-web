<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LoadStock;
use App\Models\SeedClass;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\Utils;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class LoadStockController extends Controller
{
    public function index()
    {
        $loadStocks = LoadStock::all();
        return response()->json($loadStocks);
    }

    public function store(Request $request)
    {
       
        $rules = [
            'seed_class' => 'required|exists:seed_classes,id|numeric',
            'crop_declaration_id' => 'nullable|exists:crop_declarations,id|numeric',
            'crop_variety_id' => 'required|exists:crop_varieties,id|numeric',
            'user_id' => 'required|exists:users,id|numeric',
            'yield_quantity' => 'required',
            
        ];

        try {
            // Validate the incoming request data
            $validatedData = Validator::make($request->all(), $rules)->validate();
            
            // Automatically set the 'mobile' field to 'yes'
            $validatedData['mobile'] = 'yes';
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        }
    
        $loadStock = LoadStock::create($validatedData );
        return Utils::apiSuccess($loadStock, 'Crop Stock submitted successfully.');
    }

    public function show($id)
    {
        $loadStock = LoadStock::where('user_id', $id)->get();
        $result = [];
        //for each get the seed class object
        foreach ($loadStock as $stock) {
            $seed_class = SeedClass::find($stock->seed_class);
            $result[] = [
                'load_stock' => $stock,
                'seed_class' => $seed_class
            ];
        }

        return response()->json($result);
    }

    public function update(Request $request, $id)
    {
        $loadStock = LoadStock::findOrFail($id);

        $rules = [
            'seed_class' => 'required|exists:seed_classes,id|numeric',
            'crop_declaration_id' => 'nullable|exists:crop_declarations,id|numeric',
            'crop_variety_id' => 'required|exists:crop_varieties,id|numeric',
            'user_id' => 'required|exists:users,id|numeric',
            'yield_quantity' => 'required',
            
        ];

        try {
            // Validate the incoming request data
            $validatedData = Validator::make($request->all(), $rules)->validate();
            
            // Automatically set the 'mobile' field to 'yes'
            $validatedData['mobile'] = 'yes';
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        }

        $loadStock->update($validatedData );
        return Utils::apiSuccess($loadStock, 'Crop Stock edited successfully.');
    }

    public function destroy($id)
    {
        $loadStock = LoadStock::findOrFail($id);
        $loadStock->delete();
        return Utils::apiSuccess($loadStock, 'Crop Stock deleted successfully.');
    }
}
