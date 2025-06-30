<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppointmentQueue extends Model
{
    use HasFactory;
    public $table = 'appointment_queues';
    protected $primaryKey = 'queueId';
    protected $fillable = ['queueId','patientId', 'queueNumber', 'scheduledBy'];

    public function patients()
    {
        return $this->belongsTo(Patients::class, 'patientId', 'patientId');
    }

    public function scheduledBy()
    {
        return $this->belongsTo(User::class, 'scheduledBy', 'id');
    }

    public function appointment()
    {
        return $this->belongsTo(Appointments::class);
    }

    
}
