<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CooperativeMember;

class Cooperative extends Model
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

    //relatinship with cocperative members
    public function members()
    {
        return $this->hasMany(CooperativeMember::class, 'cooperative_id');
    }
}
