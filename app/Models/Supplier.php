<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'contact_person',
        'phone',
        'email',
        'address',
        'status'
    ];

    // Relasi: One-to-Many dengan Contracts dan RawMaterialBatches
    public function contracts()
    {
        return $this->hasMany(Contract::class, 'supplier_id');
    }

    public function rawMaterialBatches()
    {
        return $this->hasMany(RawMaterialBatch::class, 'supplier_id');
    }
}
