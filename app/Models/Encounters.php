<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Encounters extends Model
{
    use HasFactory;
    public $table = 'encounters';
    protected $fillable = ['consultingId', 'continueConsultingId', 'status'];
    protected $primaryKey = 'encounterId';
    public function consulting()
    {
        return $this->hasMany(Consulting::class, 'consultingId', 'consultingId');
    }

    public function continue_consulting()
    {
        return $this->hasMany(ContinueConsulting::class, 'continueConsultingId', 'continueConsultingId');
    }
}
