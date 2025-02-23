<?php

namespace App\Models;

use Encore\Admin\Auth\Database\Role;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeedClass extends Model
{
    use HasFactory;

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_seed_class');
    }

}
