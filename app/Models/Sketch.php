<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sketch extends Model
{
    use HasFactory;
    public $table = 'sketch';
    protected $fillable = ['sketchId','patientId', 'encounterId', 'rightEyeFront', 'rightEyeBack', 'leftEyeFront', 'leftEyeBack'];
    protected $primaryKey = 'sketchId';
  
}
