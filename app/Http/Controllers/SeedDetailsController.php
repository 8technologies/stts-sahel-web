<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\SeedLab;
use Illuminate\Http\Request;
use App\Models\LoadStock;
use App\Models\CropDeclaration;
use App\Models\CropVariety;
use App\Models\Crop;
use App\Models\SeedClass;


class SeedDetailsController extends Controller
{
    public function index()
    {
        return view('track_and_trace.track_trace_form');
    }

    public function trace(Request $request)
      {
       
        if($request-> lot_number){
          
            $seedLab = SeedLab::where('lot_number', $request->lot_number)->first();
            
        
            if (!$seedLab) {
                return response()->json(null);
            }
        
            $loadStock = LoadStock::where('id', $seedLab->load_stock_id)
                ->where('user_id', $seedLab->user_id)
                ->first();
            
            if (!$loadStock) {
                return response()->json(null);
            }
        
            $crop_declaration = $loadStock->crop_declaration_id;
        
            if (!$crop_declaration) {
                return response()->json(null);
            }
        
            $crop_declaration = CropDeclaration::where('id', $crop_declaration)
                ->first();
        
            if (!$crop_declaration) {
                return response()->json(null);
            }
        
            $crop_variety = CropVariety::where('id', $crop_declaration->crop_variety_id)
                ->first();
        
            if (!$crop_variety) {
                return response()->json(null);
            }
        
            $crop = Crop::where('id', $crop_variety->crop_id)
                ->value('crop_name');
        
            if (!$crop) {
                return response()->json(null);
            }

            $generation = SeedClass::where('id', $loadStock->seed_class)
                ->value('class_name');
            
            if (!$generation) {
                return response()->json(null);
            }
        
            $data = [
                'crop' => $crop,
                'crop_variety' => $crop_variety->crop_variety_name,
                'generation' =>  $generation,
                'seed_class' => $seedLab->seed_class,
                'lab_test_number'=> $seedLab->seed_lab_test_report_number,
                'germination' => $seedLab->germination_test_results,
                'purity' => $seedLab->purity_test_results,
                'testing_methods' => $seedLab->testing_methods,
                'test_decision'=> $seedLab->test_decision,
                'lot_number' => $seedLab->lot_number,
                'mother_lot' => $crop_declaration->source_lot_number,
                'moisture' => $seedLab->moisture_content_test_results,
                'test_date' => $seedLab->updated_at,
                
                
            ];
        }
          return response()->json($data);
      }
      

  
      public function track(Request $request)
        {
            
            $seed_details = [];
           
            if ($request->lot_number) {
                $seed_details = SeedLab::where('mother_lot', $request->lot_number)
                    ->get(['id', 'lot_number']);
            }
            
 

            return response()->json($seed_details);
        }
      
}
