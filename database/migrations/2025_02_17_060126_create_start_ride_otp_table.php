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
        Schema::create('start_ride_otp', function (Blueprint $table) {
            $table->id();
            $table->string('driver_id')->nullable();
            $table->string('booking_id')->nullable();
            $table->string('otp')->nullable();
            $table->string('expire_on')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('start_ride_otp');
    }
};
