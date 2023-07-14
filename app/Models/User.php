<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Encore\Admin\Auth\Database\Administrator;
use Tymon\JWTAuth\Contracts\JWTSubject;
use App\Models\CooperativeMember;


class User extends Authenticatable implements JWTSubject
{

    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'admin_users';


    // Rest omitted for brevity

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'username',
        'name',
        'email',
        'password',
        'value_chains',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    //relationship with cooperatives
    public function cooperatives()
    {
        return $this->belongsTo(Cooperative::class);
    }

    //assign a user a role of 3 once they are registered
    public static function boot()
    {
        parent::boot();
        static::created(function ($user) {
            $user = Administrator::find($user->id);
            $user->roles()->attach(3);
        });
    }
}
