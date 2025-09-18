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

    // Relasi: Many-to-One dengan Suppliers, One-to-Many dengan RawMaterialStock dan ProductionMaterials
    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }

    public function rawMaterialStock()
    {
        return $this->hasMany(RawMaterialStock::class, 'raw_batch_id');
    }

    public function productionMaterials()
    {
        return $this->hasMany(ProductionMaterial::class, 'raw_batch_id');
    }
}
