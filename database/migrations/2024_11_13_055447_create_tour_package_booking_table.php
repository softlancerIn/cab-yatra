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
        Schema::create('tour_package_booking', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('mobile')->nullable();
            $table->string('email')->nullable();
            $table->string('pickUpLoc')->nullable();
            $table->string('pickUp_date')->nullable();
            $table->string('pickUp_time')->nullable();
            $table->string('coupon_id')->nullable();
            $table->string('biling_name')->nullable();
            $table->string('biling_gstNo')->nullable();
            $table->string('add_onService')->nullable()->comment('Free luaggage, pet for 300rs');
            $table->enum('payment_mode', ['1', '0'])->default('1')->comment('1: 100% amount, 0: 10% minimum amount of booking');
            $table->string('total_faire')->nullable();
            $table->string('payment_infoId')->nullable();
            $table->enum('status', ['0', '1', '2', '3'])->default('1')->comment('0: initiate, 1: accepted, 2: completed, 3:rejected ');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tour_package_booking');
    }
};
