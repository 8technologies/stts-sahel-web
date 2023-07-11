<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CropSeedProducer extends Model
{
    use HasFactory;

    protected $fillable = [
        'crop_id',
        'seed_producer_id',
    ];

    public function crops()
    {
        return $this->belongsTo(Crop::class, 'crop_id', 'id');
    }

    public function seed_producers()
    {
        return $this->belongsTo(SeedProducer::class, 'seed_producer_id', 'id');
    }
}
