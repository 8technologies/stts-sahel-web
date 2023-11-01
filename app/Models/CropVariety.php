<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \App\Models\Crop;
use \App\Models\InspectionType;
use \App\Models\CropDeclaration;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class CropVariety extends Model
{
    use HasFactory;

    protected $fillable = [
        'crop_variety_name',
        'crop_variety_code',
        'crop_variety_generation',

    ];

    public function getNameTextAttribute()
    {
        $c = $this->crop;
        if ($c == null) {
            return $this->crop_variety_name;
        }
        return $c->crop_name . ", " . $this->crop_variety_name;
    }

    protected $appends = [
        'name_text'
    ];

    public function crops()
    {
        return $this->belongsTo(Crop::class);
    }

    public function crop()
    {
        return $this->belongsTo(Crop::class);
    }

    public function inspection_types()
    {
        $pivotTable = 'crop_variety_inspection_types';

        $relatedModel = InspectionType::class;

        return $this->belongsToMany($relatedModel, $pivotTable, 'crop_variety_id', 'inspection_type_id');
    }


    public function crop_declarations(): BelongsToMany
    {
        $pivotTable = 'crop_variety_crop_declaration';

        $relatedModel = CropDeclaration::class;

        return $this->belongsToMany($relatedModel, $pivotTable,  'crop_variety_id', 'crop_declaration_id');
    }

    public static function boot()
    {

        parent::boot();
        static::creating(function ($variety) {
            $variety->crop_variety_code = $variety->generateCropCode();
            $variety->crop_variety_name = ucfirst(strtolower($variety->crop_variety_name));

        });
    }

    public function generateCropCode()
    {
     //get the first 3 letters of the crop name and capitalize them
        $crop_variety_name = strtoupper(substr($this->crop_variety_name, 0, 3));
        return $crop_variety_name;
    }
}
