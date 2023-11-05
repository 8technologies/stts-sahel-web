<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoadStock extends Model
{
    use HasFactory;

    protected $fillable = [
        'load_stock_number',
        'crop_declaration_id',
        'crop_variety_id',
        'user_id',
        'registration_number',
        'seed_class',
        'field_size',
        'yield_quantity',
        'last_field_inspection_date',
        'load_stock_date',
        'status',
    ];

    public function crop_declaration()
    {
        return $this->belongsTo(CropDeclaration::class);
    }
}
