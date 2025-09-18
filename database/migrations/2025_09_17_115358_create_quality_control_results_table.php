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
        Schema::create('quality_control_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('production_id')->constrained('production_batches')->onDelete('cascade');
            $table->integer('sample_count')->nullable();
            $table->string('result', 100)->nullable();
            $table->enum('status', ['Pass', 'Fail'])->default('Pass');
            $table->string('defect_type', 100)->nullable();
            $table->text('action_taken')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quality_control_results');
    }
};
