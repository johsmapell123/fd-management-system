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

    // Relasi: One-to-Many dengan RawMaterialStock dan FinishedGoodsStock
    public function rawMaterialStock()
    {
        return $this->hasMany(RawMaterialStock::class, 'warehouse_id');
    }

    public function finishedGoodsStock()
    {
        return $this->hasMany(FinishedGoodsStock::class, 'warehouse_id');
    }
}
