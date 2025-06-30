<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctors extends Model
{
    use HasFactory;
    public $table = 'doctors';
    protected $fillable = ['doctorName','title', 'department', 'status', 'userId'];

    public function patients()
    {
        return $this->hasMany(Patients::class, 'doctor', 'doctorId');
    }

    public function doctors()
    {
        return $this->belongsTo(Users::class, 'userId', 'id');
    }

     public function appointments()
    {
        return $this->hasMany(Appointments::class);
    }
}
