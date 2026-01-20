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
        Schema::create('local_packages', function (Blueprint $table) {
            $table->id();
            $table->string('time')->nullable();
            $table->string('category')->nullable();
            $table->string('type')->nullable();
            $table->string('fair')->nullable();
            $table->string('extra_fair_perKm')->nullable();
            $table->string('extra_fair_perHour')->nullable();
            $table->string('fuel_charge')->nullable();
            $table->string('driver_charge')->nullable();
            $table->string('night_charge')->nullable();
            $table->string('other_details')->nullable();
            $table->enum('status', ['1', '0'])->default('1')->comment('1: Active, 1: Inactive');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('local_packages');
    }
};
