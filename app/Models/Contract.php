<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Contract extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'supplier_id',
        'material',
        'price',
        'delivery_schedule',
        'contact_duration',
        'payment_status',
        'created_at',
        'updated_at'
    ];

    // Relasi: Many-to-One dengan Suppliers
    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }
}
