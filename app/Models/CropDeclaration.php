<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \App\Models\CropVariety;
use \App\Models\Notification;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\FieldInspection;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class CropDeclaration extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'phone_number',
        'garden_size',
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
        'seed_class_id',
        'crop_variety_id',
        'out_grower_id',
        'status_comment',
        'details',
        'mobile'

    ];

    protected $casts = [
        'phone_number' => 'integer',
        'garden_size' => 'decimal:2',
        'quantity_of_seed_planted' => 'decimal:2',
        'expected_yield' => 'decimal:2',
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
        self::created(function ($model) {
            Notification::send_notification($model, 'CropDeclaration', request()->segment(count(request()->segments())));
        });

      
        self::updated(function ($model)
         {
            //call back to send a notification to the user after form is updated
            
            if ($model->status == 'inspector assigned') {
                $crop_variety = CropVariety::find($model->crop_variety_id);
                // if ($crop_variety == null) {
                //     return;
                // }
                // $croped = $crop_variety->crop->
                // $crop = Crop::find($crop_variety->crop_id);
                // if ($crop == null) {
                //     return;
                // }
                Log::info([$model->crop_variety_id]);
                Log::info([$crop_variety->crop_id]);

                // $inspectionTypes = $crop->inspection_types()->orderBy('order')->pluck('id');
                $inspectionTypes = $crop_variety->crop->inspection_types()
                ->select(['id', 'order', 'period_after_planting']) // Select only the necessary columns
                ->orderBy('order')
                ->get();
                Log::info([$inspectionTypes]);

                $isFirst = true;
                foreach ($inspectionTypes as  $type) {
                    // $inspection = FieldInspection::where([
                    //     'crop_declaration_id' => $model->id,
                    //     'inspection_type_id' => $type->id,
                    // ])->first();
                    // if ($inspection != null) {
                    //     continue;
                    // }
                    $inspection = new FieldInspection();
                    $inspection->crop_variety_id = $crop_variety->id;
                    $inspection->inspection_type_id = $type->id;
                    $inspection->crop_declaration_id = $model->id;
                    $inspection->user_id = $model->user_id;
                    $inspection->physical_address = $model->village;
                    $inspection->field_size = $model->garden_size;
                    $inspection->inspector_id = $model->inspector_id;
                    $inspection->order_number = $type->order;
                    $inspection->status = 'inspector assigned';
                    $inspection->is_done = 0;

                    
                    try {
                        $pd = Carbon::parse($model->planting_date);
                        $inspection->inspection_date = $pd->addDays((int)($type->period_after_planting))->format('Y-m-d');
                    } catch (\Exception $e) {
                    }

                    Log::info([$inspection]);

                    if ($isFirst) {
                        $inspection->is_active = 1;
                        $isFirst = false;
                    } else {
                        $inspection->is_active = 0;
                    }

                    $inspection->save();
                }
            }
        });
    }
}
