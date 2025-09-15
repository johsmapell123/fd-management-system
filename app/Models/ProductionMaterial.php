<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class ProductionMaterial extends Model
{
    use HasFactory;
    protected $fillable = [
        'production_id',
        'raw_batch_id',
        
        'quantity_used'
    ];

    public function production()
    {
        return $this->belongsTo(ProductionBatch::class, 'production_id', 'id');
    }

    public function rawMaterial()
    {
        return $this->belongsTo(RawMaterialBatch::class, 'raw_batch_id', 'id');
    }
}
