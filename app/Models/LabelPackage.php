<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabelPackage extends Model
{
    use HasFactory;

    protected $fillable = [
        'price',
        'package_type',
        'seed_generation',
        'quantity',

    ];

    public function seedLabels()
    {
        return $this->hasMany(SeedLabelPackage::class,'package_id');
    }

    //api relationships
    public function seedLabel()
    {
        return $this->belongsToMany(SeedLabel::class, 'seed_label_packages','package_id', 'seed_label_id')
            ->withPivot('quantity'); // Add pivot fields as needed
    }
}
