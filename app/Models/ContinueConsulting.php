<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContinueConsulting extends Model
{
    use HasFactory;
    public $table = 'continue_consulting';
    protected $fillable = [
        'encounterId',
'intraOccularPressureRight',
'intraOccularPressureLeft',
'otherComplaintsRight',
'otherComplaintsLeft',
'detailedHistoryRight',
'detailedHistoryLeft',
'findingsRight',
'findingsLeft',
'eyelidRight',
'eyelidLeft',
'conjunctivaRight',
'conjunctivaLeft',
'corneaRight',
'corneaLeft',
'ACRight',
'ACLeft',
'irisRight',
'irisLeft',
'pupilRight',
'pupilLeft',
'lensRight',
'lensLeft',
'vitreousRight',
'vitreousLeft',
'retinaRight',
'retinaLeft',
'otherFindingsRight',
'otherFindingsLeft',
'chiefComplaintRight',
'chiefComplaintLeft',
    ];
    protected $primaryKey = 'continueConsultingId';
    public function encounters()
    {
        return $this->belongsTo(Encounters::class, 'encounterId', 'encounterId');
    }
}
