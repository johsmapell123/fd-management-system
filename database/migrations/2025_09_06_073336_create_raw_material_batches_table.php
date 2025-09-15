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
        Schema::create('raw_material_batches', function (Blueprint $table) {
            $table->id(); // PRIMARY KEY 'id'
            $table->string('batch_code', 50)->unique();   // contoh: PM-250813-01
            $table->foreignId('supplier_id')->constrained('suppliers')->onDelete('cascade');
            $table->enum('material_type', ['Flour', 'Salt', 'Kansui']);
            $table->date('received_date');
            $table->decimal('quantity', 10, 2);
            $table->string('unit', 20); // kg, liter
            $table->enum('status', ['OK', 'Rejected', 'In Use'])->default('OK');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('raw_material_batches');
    }
};
