<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cooperatives extends Model
{
    use HasFactory;

    protected $fillable = [
        'cooperative_number',
        'cooperative_name',
        'registration_number',
        'cooperative_physical_address',
        'contact_person_name',
        'contact_phone_number',
        'contact_email',
        'membership_type',
        'services_to_members',
        'objectives_or_goals'
    ];
}
