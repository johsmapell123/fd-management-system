<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RawMaterialBatch extends Model
{
    use HasFactory;
    protected $fillable = [
        'batch_code',
        'supplier_id',
        'material_type',
        'received_date',
        'quantity',
        'unit',
        'status'
    ];

    // Batch ini dimiliki oleh satu supplier
    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }

    // Batch bisa masuk ke stok raw material
    public function stock()
    {
        return $this->hasOne(RawMaterialStock::class, 'raw_batch_id');
    }

    // Batch bisa dipakai dalam banyak produksi
    public function productionMaterials()
    {
        return $this->hasMany(ProductionMaterial::class, 'raw_batch_id');
    }
}
