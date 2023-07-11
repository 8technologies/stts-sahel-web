<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \App\Models\CropVariety;
use \App\Models\Notification;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use OpenAdmin\Admin\Facades\Admin;
use App\Models\FieldInspection;


class CropDeclaration extends Model
{
    use HasFactory;

    protected $fillable = [
        'applicant_id',
        'phone_number',
        'applicant_registration_number',
        'seed_producer_id',
        'garden_size',
        'gps_coordinates_1',
        'gps_coordinates_2',
        'gps_coordinates_3',
        'gps_coordinates_4',
        'field_name',
        'district_region',
        'circle',
        'township',
        'village',
        'planting_date',
        'quantity_of_seed_planted',
        'expected_yield',
        'seed_supplier_name',
        'seed_supplier_registration_number',
        'source_lot_number',
        'origin_of_variety',
        'garden_location_latitude',
        'garden_location_longitude',
        'status',
        'inspector_id',
        'lot_number',
        'remarks',

    ];

    protected $casts = [
        'phone_number' => 'integer',
        'garden_size' => 'decimal:2',
        'gps_coordinates_1' => 'decimal:6',
        'gps_coordinates_2' => 'decimal:6',
        'gps_coordinates_3' => 'decimal:6',
        'gps_coordinates_4' => 'decimal:6',
        'quantity_of_seed_planted' => 'integer',
        'expected_yield' => 'integer',
        'garden_location_latitude' => 'decimal:6',
        'garden_location_longitude' => 'decimal:6',
    ];

    public function crop_varieties(): BelongsToMany
    {
        $pivotTable = 'crop_variety_crop_declaration';

        $relatedModel = CropVariety::class;

        return $this->belongsToMany($relatedModel, $pivotTable, 'crop_declaration_id', 'crop_variety_id');
    }
    
    public static function boot()
    {
        parent::boot();

        //call back to send a notification to the user
        self::created(function ($model) 
        {
            Notification::send_notification($model, 'CropDeclaration', request()->segment(count(request()->segments())));
               
        });

        self::updated(function ($model) 
        {
        //call back to send a notification to the user after form is updated
            Notification::update_notification($model, 'CropDeclaration', request()->segment(count(request()->segments())-1));

            if (Admin::user()->isRole('inspector')) {
                $selectedCropVarietyIds = $model->crop_varieties()->pluck('crop_varieties.id')->toArray();
            
                foreach ($selectedCropVarietyIds as $selectedCropVarietyId) {
                    $cropVariety = CropVariety::findOrFail($selectedCropVarietyId);
                   
                    // Fetch the inspection types for the crop variety
                    $crops = $cropVariety->crop_id;
                    $inspectionTypes = Crop::findOrFail($crops)->inspection_types()->orderBy('order')->get();
                    
                    // Allocate inspections to the crop variety for each inspection type
                    foreach ($inspectionTypes as $inspectionType) {
                        $inspection = new FieldInspection();
                        $inspection->crop_variety_id = $cropVariety->id;
                        $inspection->inspection_type_id = $inspectionType->id;
                        $inspection->crop_declaration_id = $model->id;
                        $inspection->applicant_id = $model->applicant_id;
                        $inspection->inspector_id = $model->inspector_id;

                        //check inspection type order and set the is_done attribute
                        if ($inspectionType->order == 1) {
                            $inspection->is_active = 1;
                        } else {
                            $inspection->is_active = 0;
                        }
                        $inspection->save();
                    }
                }
            }
            

           
        });

    }
}
