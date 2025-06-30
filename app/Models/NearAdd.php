<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NearAdd extends Model
{
    use HasFactory;
    public $table = 'near_add';
    protected $fillable = ['name', 'status'];
}
