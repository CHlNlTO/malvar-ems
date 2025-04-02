<?php

// database/migrations/2024_04_02_000006_create_waste_collection_records_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('waste_collection_records', function (Blueprint $table) {
            $table->id('record_id');
            $table->foreignId('schedule_id')->constrained('garbage_collection_schedules', 'schedule_id')->cascadeOnDelete();
            $table->float('biodegradable_volume')->default(0);
            $table->float('non_biodegradable_volume')->default(0);
            $table->float('hazardous_volume')->default(0);
            $table->float('total_volume')->default(0);
            $table->foreignId('collector_id')->constrained('users')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('waste_collection_records');
    }
};
