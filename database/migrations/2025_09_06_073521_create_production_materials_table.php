<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('production_materials', function (Blueprint $table) {
            $table->id(); // PRIMARY KEY 'id'
            $table->foreignId('production_id')->constrained('production_batches')->onDelete('cascade');
            $table->foreignId('raw_batch_id')->constrained('raw_material_batches')->onDelete('cascade');
            
            $table->decimal('quantity_used', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('production_materials');
    }
};
