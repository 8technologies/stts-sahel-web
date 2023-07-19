<?php

namespace Encore\Admin\Controllers;

use Encore\Admin\Admin;
use Illuminate\Support\Arr;
use App\Models\CropDeclaration;
use App\Models\SeedLab;
use Carbon\Carbon;
use App\Models\Utils;
use App\Models\MarketableSeed;
use App\Models\CropVariety;
use App\Models\PreOrder;

class Dashboard
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public static function cards(){
        return view('dashboard.cards');
    }


    //CROP DECLARATION TABLE
    public static function crops()
    {
        $crops = CropDeclaration::orderBy('updated_at', 'Desc')->limit(4)->get();

        return view('dashboard.table', [ 'crops' => $crops]);
    }

   //COMAPRISON CHARTS
    //function to get the total number of marketable and unmarketable seeds for each month 
    public static function seeds()
    {
        $data = [
            'is_seed_marketable' => [],
            'created_at' => [],
            'is_seed_unmarketable' => [],
            'seeds' => [],
            'labels' => []
        ];
    
        for ($i = 12; $i >= 0; $i--) {
            $min = Carbon::now()->subMonths($i + 1)->startOfMonth();
            $max = Carbon::now()->subMonths($i)->endOfMonth();
    
            $is_seed_marketable = SeedLab::whereBetween('created_at', [$min, $max])
                ->where('test_decision', 'marketable')
                ->count();
    
            $is_seed_unmarketable = SeedLab::whereBetween('created_at', [$min, $max])
                ->where('test_decision', 'not marketable')
                ->count();
    
            $seeds = SeedLab::whereBetween('created_at', [$min, $max])->count();
    
            $data['is_seed_marketable'][] = $is_seed_marketable;
            $data['is_seed_unmarketable'][] = $is_seed_unmarketable;
            $data['seeds'][] = $seeds;
            $data['labels'][] = Utils::month($max);
        }


        return view('dashboard.comparison', $data);
    }

    //PIE CHARTS
    //function to get marketable seed crop type
    public static function marketableSeeds()
    {
        $cropVarieties = MarketableSeed::pluck('crop_variety_id');
    
        $data = [];
    
        foreach ($cropVarieties as $cropVarietyId) {
            // Get the respective crop that the crop variety belongs to
            $cropVariety = CropVariety::find($cropVarietyId);
    
            if ($cropVariety) {
                // Get the crop name
                $cropName = $cropVariety->crop->crop_name;
    
                // Increment the count for the crop name in the data array
                if (!isset($data[$cropName])) {
                    $data[$cropName] = 0;
                }
    
                $data[$cropName]++;
            }
        }
    
        // Separate the names and their respective counts into different variables
        $names = array_keys($data);
        $counts = array_values($data);
    
        // Return the data as an associative array
        return view('dashboard.pieChart', ['names' => $names, 'counts' => $counts]);
    }

    //PRE-ORDER TABLE
    //function to get the pre-orders
    public static function preOrders()
    {
        $preOrders = PreOrder::orderBy('updated_at', 'Desc')->limit(4)->get();

        return view('dashboard.preorder_table', [ 'preOrders' => $preOrders]);
    }

    
}