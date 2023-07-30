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
use App\Models\SeedProducer;
use App\Models\AgroDealers;
use App\Models\Cooperative;
use App\Models\FieldInspection;
use App\Models\LoadStock;
use App\Models\SeedLabelPackage;
use Illuminate\Support\Facades\DB;


class Dashboard
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    //function to get the totals
    public static function cards()
    {
        $data = [
            'total_producers' => SeedProducer::count(),
            'pending_producers' => SeedProducer::where('status', 'pending')->orWhere('status', null)->count(),
            'total_cooperatives' => Cooperative::count(),
            'pending_cooperatives' => Cooperative::where('status', 'pending')->orWhere('status', null)->count(),
            'total_agro_dealers' => AgroDealers::count(),
            'pending_agro_dealers' => AgroDealers::where('status', 'pending')->orWhere('status', null)->count(),
            'total_marketable_seeds' => MarketableSeed::count(),
        ];

        return view('dashboard.cards', ['data' => $data]);
    }


    //CROP DECLARATION TABLE
    public static function crops()
    {
        $crops = CropDeclaration::orderBy('updated_at', 'Desc')->limit(4)->get();

        return view('dashboard.table', ['crops' => $crops]);
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

        return view('dashboard.preorder_table', ['preOrders' => $preOrders]);
    }

    //inspections
    public static function inspectionsChart()
    {
        $inspections = FieldInspection::all();

        // Group inspections by status
        $statusGroups = $inspections->groupBy('field_decision');

        // Prepare the data for the chart
        $chartData = [
            'labels' => ['Accepted/Rejected', 'Pending/Processed'],
            'datasets' => [
                [
                    'label' => 'Accepted',
                    'data' => [
                        $statusGroups->get('accepted')->count(),
                        0, // 0 count for the "Pending/Processed" label
                    ],
                    'backgroundColor' => 'rgba(54, 162, 235, 0.5)',
                ],
                [
                    'label' => 'Rejected',
                    'data' => [
                        $statusGroups->get('rejected')->count(),
                        0, // 0 count for the "Pending/Processed" label
                    ],
                    'backgroundColor' => 'rgba(255, 99, 132, 0.5)',
                ],
                [
                    'label' => 'Pending',
                    'data' => [
                        0, // 0 count for the "Accepted/Rejected" label
                        $statusGroups->get('pending')->count(),
                    ],
                    'backgroundColor' => 'rgba(75, 192, 192, 0.5)',
                ],
                [
                    'label' => 'Processed',
                    'data' => [
                        0, // 0 count for the "Accepted/Rejected" label
                        $inspections->count() - $statusGroups->get('pending')->count(),
                    ],
                    'backgroundColor' => 'rgba(255, 206, 86, 0.5)',
                ],
            ],
        ];

        return view('dashboard.inspections_stack', compact('chartData'));
    }
    //marketable vs loadstock
    public static function getProcessedAndUnprocessedSeedsPerCrop()
    {
        // Retrieve the data for unprocessed seeds
        $unprocessedSeedsData = LoadStock::select('crop_variety_id', DB::raw('count(*) as count'))
            ->groupBy('crop_variety_id')
            ->get();

        // Retrieve the data for processed seeds
        $processedSeedsData = MarketableSeed::select('crop_variety_id', DB::raw('count(*) as count'))
            ->groupBy('crop_variety_id')
            ->get();

        // Combine the data and organize it by crop_variety_id
        $combinedData = [];

        foreach ($unprocessedSeedsData as $data) {
            $combinedData[$data->crop_variety_id]['load_stocks'] = $data->count;
        }

        foreach ($processedSeedsData as $data) {
            $cropVarietyId = $data->crop_variety_id;
            if (isset($combinedData[$cropVarietyId])) {
                $combinedData[$cropVarietyId]['marketable_seeds'] = $data->count;
            } else {
                $combinedData[$cropVarietyId]['marketable_seeds'] = $data->count;
                $combinedData[$cropVarietyId]['load_stocks'] = 0;
            }
        }

        // Fetch the crop names corresponding to crop_variety_id
        $crop_names = CropVariety::whereIn('id', array_keys($combinedData))
            ->with('crop') // Load the crop relationship
            ->get()
            ->pluck('crop.crop_name', 'id')
            ->toArray();


        // Return the data as an associative array
        return view('dashboard.seed_processing', ['data' => $combinedData, 'crop_names' => $crop_names]);
    }
    //seed paackages
    public static function compareCropsByPackage()
    {
        $crops_data = SeedLabelPackage::select('seed_label_packages.quantity', 'label_packages.quantity as label_quantity', 'crops.crop_name')
            ->join('label_packages', 'label_packages.id', '=', 'seed_label_packages.package_id')
            ->join('seed_labels', 'seed_label_packages.seed_label_id', '=', 'seed_labels.id')
            ->join('seed_labs', 'seed_labels.seed_lab_id', '=', 'seed_labs.id')
            ->join('load_stocks', 'seed_labs.load_stock_id', '=', 'load_stocks.id')
            ->join('crop_varieties', 'load_stocks.crop_variety_id', '=', 'crop_varieties.id')
            ->join('crops', 'crop_varieties.crop_id', '=', 'crops.id')
            ->groupBy('seed_label_packages.quantity', 'label_packages.quantity', 'crops.crop_name')
            ->get();
        return view('dashboard.packages', compact('crops_data'));
    }
}
