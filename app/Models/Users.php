<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Users extends Authenticatable implements JWTSubject
{
    use HasFactory;
    use SoftDeletes;
    use HasApiTokens, Notifiable;

    public $table = 'users';
    protected $fillable = [
        'phoneNumber',
        'email',
        'role',
        'firstName',
        'lastName',
        'password'
    ];
    protected $dates = ['deleted_at'];


    public function getJWTIdentifier()
    {
        return $this->getKey(); // Returns the user's primary key (e.g., ID)
    }

    public function getJWTCustomClaims()
    {
        return [
            'role' => $this->role, // Add custom claims, e.g., role (pharmacist, doctor, etc.)
        ];
    }

    public function role()
    {
        return $this->hasOne(Roles::class, 'roleId', 'role'); // Assuming doctorId is the foreign key
    }

     public function user_role()
    {
        return $this->belongsTo(Roles::class, 'role', 'roleId'); 
    }
}
