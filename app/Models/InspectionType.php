<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InspectionType extends Model
{
    use HasFactory;

    protected $fillable = [
        'inspection_type_name',
        'order',
        'period_after_planting',

    ];

    public function crops()
    {
        $pivotTable = 'crop_inspection_types';
        $relatedModel = InspectionType::class;
        return $this->belongsToMany($relatedModel, $pivotTable, 'inspection_type_id', 'crop_id');
    }
    
    public function crop()
    {
        return $this->belongsTo(Crop::class);
    }

    public function crop_varieties()
    {
        $pivotTable = 'crop_variety_inspection_types';

        $relatedModel = InspectionType::class;

        return $this->belongsToMany($relatedModel, $pivotTable, 'inspection_type_id', 'crop_variety_id');
    }
}
