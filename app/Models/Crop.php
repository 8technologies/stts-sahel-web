<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use \App\Models\SeedProducer;
use \App\Models\CropVariety;


class Crop extends Model
{  
    protected $fillable = [
        'crop_name',
        'crop_code',
        'number_of_days_before_submission',
        'seed_viability_period',
    ];

    use HasFactory;

    public function crop_varieties()
    {
        return $this->hasMany(CropVariety::class);
    }

    public function inspection_types()
    {
        $pivotTable = 'crop_inspection_type';

        $relatedModel = InspectionType::class;

        return $this->belongsToMany($relatedModel, $pivotTable, 'crop_id', 'inspection_type_id');
    }

    public function seed_producers(): BelongsToMany
    {
        $pivotTable = 'crop_seed_producers';

        $relatedModel = SeedProducer::class;

        return $this->belongsToMany($relatedModel, $pivotTable, 'crop_id', 'seed_producer_id');
    }


   
}
