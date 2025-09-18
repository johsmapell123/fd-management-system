<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RawMaterialStock extends Model
{
    protected $fillable = [
        'raw_batch_id',
        'warehouse_id',
        'available_quantity',
        'unit'
    ];

    // Relasi: Many-to-One dengan RawMaterialBatches dan Warehouses
    public function rawMaterialBatch()
    {
        return $this->belongsTo(RawMaterialBatch::class, 'raw_batch_id');
    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class, 'warehouse_id');
    }
}
