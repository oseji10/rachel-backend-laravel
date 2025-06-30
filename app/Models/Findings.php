<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Findings extends Model
{
    use HasFactory;
    public $table = 'findings';
    protected $fillable = [
        'patientId', 			
        'encounterId',
        
        'OCTRight',
        'OCTLeft',
        'FFARight',
        'FFALeft',
        'fundusPhotographyRight',
        'fundusPhotographyLeft',
        'pachymetryRight',
        'pachymetryLeft',
        'CUFTRight',
        'CUFTLeft',
        'CUFTKineticRight',
        'CUFTKineticLeft',
        'pupilRight',
        'pupilLeft',
        
    ];
    protected $primaryKey = 'findingId';
    public function encounters()
    {
        return $this->belongsTo(Encounters::class, 'encounterId', 'encounterId');
    }

    public function patients()
    {
        return $this->hasMany(Patients::class, 'patientId', 'patientId');
    }
}
