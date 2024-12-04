<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Encounters extends Model
{
    use HasFactory;
    public $table = 'encounters';
    protected $fillable = ['patientId', 'consultingId', 'continueConsultingId', 'refractionId', 'appointmentId', 'investigationId', 'treatmentId', 'diagnosisId', 'status'];
    protected $primaryKey = 'encounterId';

    public function consulting()
    {
        return $this->hasOne(Consulting::class, 'consultingId', 'consultingId');
    }

    public function continue_consulting()
    {
        return $this->hasOne(ContinueConsulting::class, 'continueConsultingId', 'continueConsultingId');
    }

    public function refraction()
    {
        return $this->hasOne(Refraction::class, 'refractionId', 'refractionId');
    }

    public function diagnosis()
    {
        return $this->hasOne(Diagnosis::class, 'diagnosisId', 'diagnosisId');
    }

    public function patients()
    {
        return $this->hasOne(Patients::class, 'patientId', 'patientId');
    }
}
