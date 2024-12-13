<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consulting extends Model
{
    use HasFactory;
    public $table = 'consulting';
    protected $fillable = [
        'patientId',
        'encounterId',
        'visualAcuityFarPresentingLeft',
        'visualAcuityFarPresentingRight',
        'visualAcuityFarPinholeRight',
        'visualAcuityFarPinholeLeft',
        'visualAcuityFarBestCorrectedLeft',
        'visualAcuityFarBestCorrectedRight',
        'visualAcuityNearLeft',
        'visualAcuityNearRight'
    ];
    protected $primaryKey = 'consultingId';
    public function encounters()
    {
        return $this->belongsTo(Encounters::class, 'encounterId', 'encounterId');
    }

    public function patients()
    {
        return $this->hasMany(Patients::class, 'patientId', 'patientId');
    }

    public function visualAcuityFarPresentingRight()
    {
        return $this->belongsTo(VisualAcuityFar::class, 'visualAcuityFarPresentingRight', 'id');
    }


    public function visualAcuityFarPresentingLeft()
    {
        return $this->belongsTo(VisualAcuityFar::class, 'visualAcuityFarPresentingLeft', 'id');
    }
}
