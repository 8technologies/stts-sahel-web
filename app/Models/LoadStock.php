<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoadStock extends Model
{
    use HasFactory;

    protected $fillable = [
        'load_stock_number',
        'planting_return_number',
        'name_of_applicant',
        'registration_number',
        'seed_class',
        'field_size',
        'yield_quantity',
        'last_field_inspection_date',
        'load_stock_date',
        'last_field_inspection_remarks',
    ];

    public function crop_declaration()
    {
        return $this->belongsTo(CropDeclaration::class);
    }
}
