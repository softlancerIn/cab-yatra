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
        Schema::table('time_schadule', function (Blueprint $table) {
            $table->string('per_km_fair')->nullable();
            $table->string('duration')->nullable();
            $table->string('distance')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('time_schadule', function (Blueprint $table) {
            //
        });
    }
};
