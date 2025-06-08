<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('waste_collection_records', function (Blueprint $table) {
            $table->foreignId('mrf_id')
                ->nullable()
                ->after('collector_id')
                ->constrained('material_recycling_facilities', 'mrf_id')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('waste_collection_records', function (Blueprint $table) {
            $table->dropForeign(['mrf_id']);
            $table->dropColumn('mrf_id');
        });
    }
};
