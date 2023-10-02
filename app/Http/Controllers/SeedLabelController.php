<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SeedLabel;
use App\Models\LabelPackage;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\Utils;

class SeedLabelController extends Controller
{
    public function index()
    {
        $seedLabels = SeedLabel::all();
        return response()->json($seedLabels);
    }

    public function store(Request $request)
    {
            // Extract seed label attributes from the request
            $seedLabelData = $request->only([
                'seed_label_request_number',
                'applicant_id',
                'registration_number',
                'seed_lab_id',
                'quantity_of_seed',
                'proof_of_payment',
                'request_date',
                'applicant_remarks',
            ]);
    
            // Extract package data from the request
            $packagesData = $request->input('label_packages', []);
    
            // Create a new seed label
            $seedLabel = SeedLabel::create($seedLabelData);
    
           // Associate packages with the seed label using pivot table
            foreach ($packagesData as $packageData) {
                $packageId = $packageData['package_id'];
                $quantity = $packageData['quantity'];

                // Use attach with the related model's ID and additional pivot data
                $seedLabel->labelPackages()->attach($packageId, ['quantity' => $quantity]);
            }
                
        return Utils::apiSuccess($seedLabel, 'Seed Label Request submitted successfully.');
    }

    public function show($id)
    {
        $seedLabel = SeedLabel::with('labelPackages')->where('user_id', $id)->get();

        return response()->json($seedLabel);
    }

    public function update(Request $request, $id)
    {
        $seedLabel = SeedLabel::findOrFail($id);

        // Update seed label attributes
        $seedLabel->update($request->all());

        // Update associated packages
        $packagesData = $request->input('label_packages', []);

        // Sync packages in the pivot table
        $seedLabel->labelPackages()->sync([]);
        foreach ($packagesData as $packageData) {
            $packageId = $packageData['package_id'];
            $quantity = $packageData['quantity'];

            // Use sync with pivot data to update packages
            $seedLabel->labelPackages()->sync([$packageId => ['quantity' => $quantity]], false);
        }
        return Utils::apiSuccess($seedLabel, 'Seed Label Request edited successfully.');
    }

    public function destroy($id)
    {
        $seedLabel = SeedLabel::findOrFail($id);

        // Detach all associated packages
        $seedLabel->labelPackages()->detach();

        // Delete the seed label
        $seedLabel->delete();
        return Utils::apiSuccess($seedLabel, 'Seed Label Request deleted successfully.');
    }
}
