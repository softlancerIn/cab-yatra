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
        Schema::create('driver_car_details', function (Blueprint $table) {
            $table->id();
            $table->string('driver_id')->nullable();
            $table->string('car_brand')->nullable();
            $table->string('car_name')->nullable();
            $table->string('car_no')->nullable();
            $table->enum('fuel_type', ['0', '1', '2', '3', '4'])->default('0')->comment('0: Petrol, 1:Diesel, 2:CNG, 3:Electric, 4:other');
            $table->string('no_seat')->nullable();
            $table->string('car_image')->nullable();
            $table->string('insurence_image')->nullable();
            $table->string('insurence_expiry')->nullable();
            $table->string('car_rc_frontImage')->nullable();
            $table->string('car_rc_backImage')->nullable();
            $table->enum('status', ['1', '0'])->default('1')->comment('1: Active, 0: Inactive');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('driver_car_details');
    }
};
