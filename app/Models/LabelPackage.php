<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabelPackage extends Model
{
    use HasFactory;

    protected $fillable = [
        'price',
        'quantity',

    ];

    public function seedLabels()
    {
        return $this->hasMany(SeedLabelPackage::class,'package_id');
    }
}
