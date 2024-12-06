<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    use HasFactory;
    public $table = 'users';
    protected $fillable = [
        'phoneNumber',
        'email',
        'role',
        'firstName',
        'lastName',
        'password'
    ];

    public function role()
    {
        return $this->hasOne(Roles::class, 'roleId', 'role'); // Assuming doctorId is the foreign key
    }
}
