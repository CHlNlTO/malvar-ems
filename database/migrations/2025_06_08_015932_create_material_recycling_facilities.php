<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('material_recycling_facilities', function (Blueprint $table) {
            $table->id('mrf_id');
            $table->string('name', 100);
            $table->string('location', 255);
            $table->foreignId('barangay_id')->constrained('barangays', 'barangay_id')->cascadeOnDelete();
            $table->decimal('capacity', 10, 2)->comment('Daily capacity in kg');
            $table->enum('status', ['active', 'inactive', 'maintenance'])->default('active');
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('material_recycling_facilities');
    }
};
