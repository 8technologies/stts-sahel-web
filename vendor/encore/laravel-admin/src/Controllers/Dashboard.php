<?php

namespace Encore\Admin\Controllers;

use Encore\Admin\Admin;
use Illuminate\Support\Arr;
use App\Models\CropDeclaration;
use App\Models\SeedLab;
use Carbon\Carbon;
use App\Models\Utils;
use App\Models\MarketableSeed;

class Dashboard
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public static function cards(){
        return view('dashboard.cards');
    }

    public static function crops()
    {
        $crops = CropDeclaration::orderBy('updated_at', 'Desc')->limit(4)->get();

        return view('dashboard.table', [ 'crops' => $crops]);
    }

   
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

    //function to get marketable seed crop type
    public function getCropVarietiesWithCounts()
{
    $cropVarieties = MarketableSeed::pluck('crop_variety_id');

    $data = [];

    foreach ($cropVarieties as $cropVariety) {
        $crops = $cropVariety->crops;

        foreach ($crops as $crop) {
            $cropName = $crop->name;

            if (!isset($data[$cropName])) {
                $data[$cropName] = 0;
            }

            $data[$cropName]++;
        }
    }

    return view('dashboard.pieChart', $data);
}

}