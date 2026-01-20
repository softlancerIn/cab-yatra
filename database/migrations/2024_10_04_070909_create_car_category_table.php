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
        Schema::create('car_category', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('per_km_cost')->nullable();
            $table->string('extra_fair_perKm')->nullable();
            $table->string('extra_fair_perHour')->nullable();
            $table->string('fuel_charge')->nullable();
            $table->string('driver_charge')->nullable();
            $table->string('night_charge')->nullable();
            $table->string('other_details')->nullable();
            $table->string('off')->nullable();
            $table->enum('status', ['1', '0'])->default('1')->comment('1: Active, 0: Inactive');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('car_category');
    }
};
