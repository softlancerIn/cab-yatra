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
        Schema::table('cab_airport_fairs', function (Blueprint $table) {
            $table->string('max_distance')->nullable();
            $table->string('max_distance_extra_fair')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cab_airports_fairs', function (Blueprint $table) {
            //
        });
    }
};
