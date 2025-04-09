<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('environmental_clearances', function (Blueprint $table) {
            $table->string('project')->nullable()->after('status');
            $table->string('site')->nullable()->after('project');
        });
    }

    public function down(): void
    {
        Schema::table('environmental_clearances', function (Blueprint $table) {
            $table->dropColumn(['project', 'site']);
        });
    }
};
