<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiagnosisList extends Model
{
    use HasFactory;
    public $table = 'diagnosis_list';
    protected $fillable = ['name', 'status'];
}
