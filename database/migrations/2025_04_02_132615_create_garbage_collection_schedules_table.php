<?php

// database/migrations/2024_04_02_000003_create_garbage_collection_schedules_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('garbage_collection_schedules', function (Blueprint $table) {
            $table->id('schedule_id');
            $table->foreignId('barangay_id')->constrained('barangays', 'barangay_id')->cascadeOnDelete();
            $table->date('collection_date');
            $table->time('collection_time');
            $table->enum('status', ['pending', 'completed', 'missed'])->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('garbage_collection_schedules');
    }
};
