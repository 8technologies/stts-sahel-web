<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeedLabelPackage extends Model
{
    use HasFactory;

    protected $fillable = [
        'seed_label_id',
        'package_id',
        'quantity',
        'price',
    ];

    public function seedLabels()
    {
        return $this->belongsTo(SeedLabel::class, 'seed_label_id');
    }

    public function labelPackages()
    {
        return $this->belongsTo(LabelPackage::class, 'package_id');
    }

   
  
}
