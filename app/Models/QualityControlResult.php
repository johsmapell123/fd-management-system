<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QualityControlResult extends Model
{
    protected $fillable = [
        'production_id',
        'sample_count',
        'result',
        'status',
        'defect_type',
        'action_taken'
    ];
    
    // Relasi: Many-to-One dengan ProductionBatches
    public function productionBatch()
    {
        return $this->belongsTo(ProductionBatch::class, 'production_id');
    }
}
