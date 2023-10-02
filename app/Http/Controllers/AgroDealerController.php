<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AgroDealers;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\Utils;
use Illuminate\Support\Facades\Storage;

class AgroDealerController extends Controller
{
    public function index()
    {
        $agroDealers = AgroDealers::all();
        return response()->json($agroDealers);
    }

    public function store(Request $request)
    {
        $user = auth('api')->user();
        $data = $request->all();

        if ($request->has('proof_of_payment')) 
        {
          
             $photoData = $request->input('proof_of_payment');
             list($type, $photoData) = explode(';', $photoData);
             list(, $photoData) = explode(',', $photoData);
             $photoData = base64_decode($photoData);
         
             $photoPath = 'images/' . uniqid() . '.jpg'; 
             Storage::disk('admin')->put($photoPath, $photoData);
            
             $data['proof_of_payment'] = $photoPath;
         }

         $fileDataObject = $request->input('attachments_certificate');
        if (isset($fileDataObject['data'])) 
        {
             $fileData = $fileDataObject['data'];
             // Extract and decode the base64 data
             list(, $fileData) = explode(',', $fileData);
             $fileData = base64_decode($fileData);
             
             // Determine the MIME type from the "mime_type" property
             $mime = $fileDataObject['mime_type'];
            

            // Define allowed file extensions for non-image files
            $allowedExtensions = [
                'pdf' => 'application/pdf',
                'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                // Add more allowed file types here
            ];

            // Determine the file extension based on the MIME type
            $fileExtension = array_search($mime, $allowedExtensions);

            if ($fileExtension === false) 
            {
                // Handle unsupported file types
                return response()->json(['error' => 'Unsupported file type.'], 400);
            }
          
            
            // Generate a unique file name with the determined extension
            $newFileName = uniqid() . '.' . $fileExtension;
            $filePath = 'files/' . $newFileName;

            // Store the file
            Storage::disk('admin')->put($filePath, base64_decode($fileData));

            // Update the 'receipt' field in the $data array with the new file name
            $data['attachments_certificate'] = $filePath;
          
        }

        $agroDealer = AgroDealers::create($data);
        return Utils::apiSuccess($agroDealer, 'Agro Dealer submitted successfully.');
    }

    public function show($id)
    {
        $agroDealer = AgroDealers::findOrFail($id);

        return response()->json($agroDealer);
    }

    public function update(Request $request, $id)
    {
        $agroDealer = AgroDealers::findOrFail($id);

        $data = $request->all();
        $agroDealer->update($data);
        return Utils::apiSuccess($agroDealer, 'Agro Dealer edited successfully.');
    }

    public function destroy($id)
    {
        $agroDealer = AgroDealers::findOrFail($id);
        $agroDealer->delete();
        return Utils::apiSuccess($agroDealer, 'Agro Dealer deleted successfully.');
    }
}
