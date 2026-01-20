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
        Schema::create('cab_airport_fairs', function (Blueprint $table) {
            $table->id();
            $table->string('car_category');
            $table->string('min_distance');
            $table->string('min_fair');
            $table->string('extra_fair_perKm');
            $table->string('off');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cab_airport_fairs');
    }
};
