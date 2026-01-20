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
        Schema::create('driver', function (Blueprint $table) {
            $table->id();
            $table->string('uniqId')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('aadhar_no')->nullable();
            $table->string('pan_no')->nullable();
            $table->string('dl_no')->nullable();
            $table->string('driver_image')->nullable();
            $table->string('aadhar_frontImage')->nullable();
            $table->string('aadhar_backImage')->nullable();
            $table->string('dl_image')->nullable();
            $table->enum('is_verified', ['0', '1'])->default('0')->comment('0: Not Verified, 1: Verified');
            $table->enum('is_registered', ['0', '1'])->default('0')->comment('0: Not Registered, 1: Registered');
            $table->enum('status', ['0', '1'])->default('1')->comment('0: Inactive, 1: Active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('driver');
    }
};
