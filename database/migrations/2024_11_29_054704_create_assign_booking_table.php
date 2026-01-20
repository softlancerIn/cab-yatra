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
        Schema::create('assign_booking', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['0', '1', '2', '3'])->default(0)->comment('0: cabbooking, 1:tourpackage booking, 2:local package booking, 3:other');
            $table->string('driver_id')->nullable();
            $table->string('booking_id')->nullable();
            $table->string('start_time')->nullable();
            $table->string('end_time')->nullable();
            $table->enum('status', ['0', '1', '2', '3'])->default(0)->comment('0: accepted, 1:started, 2:completed, 3:rejected');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assign_booking');
    }
};
