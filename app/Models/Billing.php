<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Billing extends Model
{
    use HasFactory;
    public $table = 'billings';
    protected $fillable = [
    'billingId', 
    'billingType',
    'billingName',
    'inventoryId',
    'cost',
    'quantity',
    'paymentMethod',
    'paymentStatus',
    'paymentReference',
    'paymentDate',
    'status',
    'comments',
    'billedBy',
    ];

    
    protected $primaryKey = 'billingId';

    public function billingUploads()
    {
        return $this->belongsTo(DocumentUpload::class, 'uploadedBy', 'documentId');
    }
}
