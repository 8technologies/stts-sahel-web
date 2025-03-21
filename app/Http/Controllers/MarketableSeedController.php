<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MarketableSeed;
use App\Models\SeedLab;
use App\Models\LoadStock;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\Utils;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class MarketableSeedController extends Controller
{
    public function index()
    {
        // Fetch all marketable seeds with quantity greater than zero
        $marketableSeeds = MarketableSeed::where('quantity', '>', 0)->get();

        $result = [];

        // For each marketable seed, get the load stock and seed lab objects
        foreach ($marketableSeeds as $stock) {
            $load_stock = LoadStock::find($stock->load_stock_id);
            $seed_lab = SeedLab::find($stock->seed_lab_id);
            $user = User::find($stock->user_id);
            if ($user->isrole(['cooperative'])) {
                $telephone = DB::table('cooperatives')->where('user_id', $user->id)->value('contact_phone_number');
                
            }
            elseif($user->isrole(['grower'])){
                $telephone = DB::table('seed_producers')->where('user_id', $user->id)->value('applicant_phone_number');
                
            }
            elseif($user->isrole(['research'])){
                $telephone = DB::table('research')->where('user_id', $user->id)->value('applicant_phone_number');
               
            } 
            elseif($user->isrole(['individual-producers'])){
                $telephone = DB::table('individual_producers')->where('user_id', $user->id)->value('applicant_phone_number');
               
            } 
               
            $result[] = [
                'marketable_seed_id' => $stock->id,
                'load_stock' => $load_stock,
                'seed_lab' => $seed_lab,
                'crop_variety' => $load_stock->seed_class->name,
                'seed_generation' => $load_stock->seed_class->name,
                'user' => $user,
                'selling_price'=> ,
                'telephone'=>$telephone,
            ];
        }

        return response()->json($result);
    }


    public function store(Request $request)
    {
        $user = auth('api')->user();
        $data = $request->all();
        $marketableSeed = MarketableSeed::create($data);
        return Utils::apiSuccess($marketableSeed, 'Marketable Seed submitted successfully.');
    }
    public function show($id)
    {
        // Fetch marketable seeds where the user_id is not the provided $id and quantity is greater than zero
        $marketableSeed = MarketableSeed::where('user_id', '!=', $id)
                                        ->where('quantity', '>', 0)
                                        ->get();
    
        $result = [];
    
        foreach ($marketableSeed as $stock) {
            $load_stock = LoadStock::find($stock->load_stock_id);
            $seed_lab = SeedLab::find($stock->seed_lab_id);
            $user = User::find($stock->user_id);
            
            $result[] = [
                'marketable_seed_id' => $stock->id,
                'load_stock' => $load_stock,
                'seed_lab' => $seed_lab,
                'user' => $user
            ];
        }
    
        return response()->json($result);
    }
    
    public function update(Request $request, $id)
    {
        $marketableSeed = MarketableSeed::findOrFail($id);

        $data = $request->all();
        $marketableSeed->update($data);
        return Utils::apiSuccess($marketableSeed, 'Marketable Seed edited successfully.');
    }

    public function destroy($id)
    {
        $marketableSeed = MarketableSeed::findOrFail($id);
        $marketableSeed->delete();
        return Utils::apiSuccess($marketableSeed, 'Marketable Seed deleted successfully.');
    }
}
