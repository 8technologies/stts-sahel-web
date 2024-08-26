<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SeedLabel;
use App\Models\LabelPackage;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\Utils;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Storage;

class SeedLabelController extends Controller
{
    public function index()
    {
        $seedLabels = SeedLabel::all();
        return response()->json($seedLabels);
    }

    public function store(Request $request)
    {
        // Validation rules
        $rules = [
            'seed_label_request_number' => 'required',
            'registration_number' => 'required',
            'seed_lab_id' => 'required|numeric|exists:seed_labs,id',
            'quantity_of_seed' => 'required|numeric',
            'proof_of_payment' => 'nullable',
            'label_packages'=> 'required',
            'request_date' => 'required',
            'label_package_size' => 'required|array',
            'label_package_size.*.package_id' => 'required|exists:label_packages,id',
            'label_package_size.*.quantity' => 'required|numeric|min:1',
            'applicant_remarks' => 'nullable',
            'user_id' => 'required|exists:admin_users,id|numeric',
        ];

        // Validate the incoming request data
        $validatedData = $request->validate($rules);


        // Handle proof_of_payment
        if ($request->has('proof_of_payment')) 
        {
            $photoData = $request->input('proof_of_payment');
            list($type, $photoData) = explode(';', $photoData);
            list(, $photoData) = explode(',', $photoData);
            $photoData = base64_decode($photoData);
        
            $photoPath = 'images/' . uniqid() . '.jpg'; 
            Storage::disk('admin')->put($photoPath, $photoData);
            
            // Add the photo path to validated data
            $validatedData['proof_of_payment'] = $photoPath;
        }

        // Create a new seed label
        $seedLabel = SeedLabel::create($validatedData);

        // Associate packages with the seed label using pivot table
        foreach ($request->input('label_package_size', []) as $packageData) {
            $seedLabel->labelPackages()->attach(
                $packageData['package_id'], 
                ['quantity' => $packageData['quantity']]
            );
        }

        // Return a success response
        return Utils::apiSuccess($seedLabel, 'Seed Label Request submitted successfully.');
    }

    public function show($id)
    {
        $seedLabel = SeedLabel::with('labelPackages')->where('user_id', $id)->get();

        return response()->json($seedLabel);
    }

    public function update(Request $request, $id)
    {
        // Validation rules
        $rules = [
            'seed_label_request_number' => 'required',
            'registration_number' => 'required',
            'seed_lab_id' => 'required|numeric|exists:seed_labs,id',
            'quantity_of_seed' => 'required|numeric',
            'proof_of_payment' => 'nullable',
            'request_date' => 'required',
            'label_packages'=> 'required',
            'label_package_size' => 'required|array',
            'label_package_size.*.package_id' => 'required|exists:label_packages,id',
            'label_package_size.*.quantity' => 'required|numeric|min:1',
            'applicant_remarks' => 'nullable',
            'user_id' => 'required|exists:admin_users,id|numeric',
        ];
    
        // Validate the incoming request data
        $validatedData = $request->validate($rules);
    
        // Find the existing seed label by ID
        $seedLabel = SeedLabel::findOrFail($id);
    
        // Handle proof_of_payment update
        if ($request->has('proof_of_payment')) 
        {
            $photoData = $request->input('proof_of_payment');
            list($type, $photoData) = explode(';', $photoData);
            list(, $photoData) = explode(',', $photoData);
            $photoData = base64_decode($photoData);
        
            $photoPath = 'images/' . uniqid() . '.jpg'; 
            Storage::disk('admin')->put($photoPath, $photoData);
            
            // Add the new photo path to validated data
            $validatedData['proof_of_payment'] = $photoPath;
        }
    
        // Update the seed label with the validated data
        $seedLabel->update($validatedData);
    
        // Sync the label packages
        $packagesData = $request->input('label_package_size', []);
        $labelPackages = [];
        foreach ($packagesData as $packageData) {
            $labelPackages[$packageData['package_id']] = ['quantity' => $packageData['quantity']];
        }
        
        // Detach existing and attach new label packages
        $seedLabel->labelPackages()->sync($labelPackages);
    
        // Return a success response
        return Utils::apiSuccess($seedLabel, 'Seed Label Request updated successfully.');
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
