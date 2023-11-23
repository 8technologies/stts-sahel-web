<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FieldInspection extends Model
{
    use HasFactory;

    protected $fillable = [
        'crop_variety_id',
        'inspection_type_id',
        'field_inspection_form_number',
        'crop_declaration_id',
        'user_id',
        'physical_address',
        'field_size',
        'seed_generation',
        'crop_condition',
        'field_spacing',
        'estimated_yield',
        'remarks',
        'inspector_id',
        'signature',
        'is_active',
        'is_done',
        'order_number',
        'status',
        'inspection_date',
    ];

    public function crop_variety()
    {
        return $this->belongsTo(CropVariety::class);
    }

    public function crop_declaration()
    {
        return $this->belongsTo(CropDeclaration::class);
    }
    
    public function inspection_type()
    {
        return $this->belongsTo(InspectionType::class);
    }

    public static function boot()
    {
        parent::boot();

        //call back to send a notification to the user
        self::created(function ($model) {
            Notification::update_notification($model, 'FieldInspection', 'field-inspections');

        });


        self::updated(function ($model) 
        {

            if ($model->status == 'accepted' && $model->is_done == 0) 
            {
                $next = $model->getNext();
                if ($next != null) {
                    $model->is_done = 1;
                    $model->is_active = 0;
                    $model->save();
                    $next->is_active = 1;
                    $next->save();
                } else {
                    $crop_declaration = CropDeclaration::find($model->crop_declaration_id);
                    if ($crop_declaration != null) {
                        $crop_declaration->status = 'accepted';
                        $model->is_done = 1;
                        $model->is_active = 0;
                        $crop_declaration->save();
                        $model->save();
                    }
                }
            }
            
            if ($model->status == 'rejected' && $model->is_done == 0) 
            {
                $crop_declaration = CropDeclaration::find($model->crop_declaration_id);
                if ($crop_declaration != null) {
                    $crop_declaration->status = 'rejected';
                    $model->is_done = 1;
                    $model->is_active = 0;
                    $crop_declaration->save();
                    $model->save();
                }
            }

            Notification::update_notification($model, 'FieldInspection', request()->segment(count(request()->segments())-1));
        });
    }

    public function getNext()
    {
        $otherInspections = FieldInspection::where('crop_declaration_id', $this->crop_declaration_id)
            ->orderBy('order_number', 'asc')
            ->get();

        $nextInspection = null;
        foreach ($otherInspections as $key => $inspection) {
            if ($inspection->order_number > $this->order_number) {
                $nextInspection = $inspection;
                break;
            }
        }
        return $nextInspection;
    }
}
