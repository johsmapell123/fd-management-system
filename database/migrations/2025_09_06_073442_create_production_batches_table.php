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
            $table->string('production_code', 50)->unique();
            $table->date('production_date')->nullable();
            $table->enum('shift', ['A', 'B', 'C'])->nullable();
            $table->integer('quantity_carton')->nullable();
            $table->enum('status', ['In Production', 'In Warehouse'])->default('In Production');
            $table->text('notes')->nullable();
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
