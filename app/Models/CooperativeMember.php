<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CooperativeMember extends Model
{
    use HasFactory;
    protected $fillable = [
        'cooperative_id',
        'member_number',
        'farmer_first_name',
        'farmer_last_name',
        'gender',
        'date_of_birth',
        'nationality',
        'phone_number',
        'email_address',
        'residential_physical_address',
        'agriculture_value_chains',
        'observation',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
    ];
    //relationship with cooperatives
    public function cooperative()
    {
        return $this->belongsTo(Cooperative::class);
    }
}
