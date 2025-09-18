<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FinishedGoodsStock extends Model
{
    protected $fillable = [
        'production_id',
        'warehouse_id',
        'available_carton'
    ];

    // Relasi: Many-to-One dengan ProductionBatches dan Warehouses
    public function productionBatch()
    {
        return $this->belongsTo(ProductionBatch::class, 'production_id');
    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class, 'warehouse_id');
    }
}
