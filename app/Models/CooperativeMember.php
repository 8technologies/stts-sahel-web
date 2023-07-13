<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Cooperative;

class CooperativeMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'cooperative_id',
    ];

    //relationship with user 
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    //relationship with cooperative
    public function cooperative()
    {
        return $this->belongsTo(Cooperative::class, 'cooperative_id');
    }
}
