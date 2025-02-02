<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;
    public $table = 'inventory';
    protected $fillable = [
    'inventoryId', 
    'inventoryName',
    'inventoryType',
    'inventoryBatchNumber',
    'inventoryExpiryDate',
    'inventoryQuantityReceived',
    'inventoryQuantitySold',
    'inventoryCost',
    'inventoryPrice',
    'inventoryStatus',
    'inventoryImage',
    'inventoryManufacturer',
    'inventorySupplier',
    'inventoryQuantityDamaged',
    'inventoryQuantityReturned',
    'inventoryQuantityExpired',
    'uploadedBy'

    
    ];
    protected $primaryKey = 'inventoryId';

    public function inventoryUploads()
    {
        return $this->belongsTo(DocumentUpload::class, 'uploadedBy', 'documentId');
    }
}
