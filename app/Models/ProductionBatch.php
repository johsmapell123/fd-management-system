<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductionBatch extends Model
{
    use HasFactory;
    protected $fillable = [
        'production_code',
        'production_date',
        'shift',
        'quantity_carton',
        'status'
    ];

    // Produksi pakai banyak bahan baku
    public function materials()
    {
        return $this->hasMany(ProductionMaterial::class, 'production_id');
    }

    // Produksi menghasilkan stok barang jadi
    public function finishedStock()
    {
        return $this->hasOne(FinishedGoodsStock::class, 'production_id');
    }
}
