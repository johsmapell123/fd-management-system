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
        Schema::create('production_batches', function (Blueprint $table) {
            $table->id();
            $table->string('production_code', 50)->unique(); // contoh: RSN-250814-A
            $table->date('production_date');
            $table->string('shift', 10); // A, B, C
            $table->integer('quantity_carton');
            $table->enum('status', ['In Production', 'In Warehouse'])->default('In Production');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('production_batches');
    }
};
