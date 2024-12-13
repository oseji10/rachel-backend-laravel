<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Investigations extends Model
{
    use HasFactory;
    public $table = 'investigations';
    protected $fillable = ['investigationId', 'investigationsRequired', 'externalInvestigationRequired', 'investigationDone', 'HBP', 'diabetes', 'pregnancy', 'drugAllergy', 'currentMedication', 'documentId'];

    public function investigationDocuments()
    {
        return $this->belongsTo(DocumentUpload::class, 'documentId', 'documentId');
    }
}
