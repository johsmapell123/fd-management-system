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

    // Relasi: One-to-Many dengan ProductionMaterials, FinishedGoodsStock, QualityControlResults
    public function productionMaterials()
    {
        return $this->hasMany(ProductionMaterial::class, 'production_id');
    }

    public function finishedGoodsStock()
    {
        return $this->hasMany(FinishedGoodsStock::class, 'production_id');
    }

    public function qualityControlResults()
    {
        return $this->hasMany(QualityControlResult::class, 'production_id');
    }
}
