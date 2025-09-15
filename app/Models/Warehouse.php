<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    protected $fillable = [
        'name',
        'type',
        'location'
    ];

    public function rawStocks()
    {
        return $this->hasMany(RawMaterialStock::class, 'warehouse_id');
    }

    // Warehouse bisa punya stok barang jadi
    public function finishedStocks()
    {
        return $this->hasMany(FinishedGoodsStock::class, 'warehouse_id');
    }
}
