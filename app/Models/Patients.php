<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patients extends Model
{
    use HasFactory;
    public $table = 'patients';
    protected $primaryKey = 'patientId';
    protected $fillable = ['firstName', 'lastName', 'otherNames', 'phoneNumber', 'email', 'gender', 'bloodGroup', 'address', 'occupation', 'hospitalFileNumber', 'dateOfBirth', 'doctor', 'status'];

    public function doctor()
    {
        return $this->belongsTo(Doctors::class, 'doctor', 'doctorId'); // Assuming doctorId is the foreign key
    }
}
