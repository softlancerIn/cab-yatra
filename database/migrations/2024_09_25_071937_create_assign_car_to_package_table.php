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
        Schema::create('assign_car_to_package', function (Blueprint $table) {
            $table->id();
            $table->string('car_id')->nullable();
            $table->string('package_id')->nullable();
            $table->enum('status', ['0', '1'])->default('1')->comment('0: Inactive, 1: Active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assign_car_to_package');
    }
};
