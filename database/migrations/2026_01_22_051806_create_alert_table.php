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
        Schema::create('alert', function (Blueprint $table) {
            $table->id();
            $table->string('driver_id');
            $table->string('alert_type')->nullable();
            $table->json('cars_id')->nullable();
            $table->json('locations')->nullable();
            $table->enum('manually_pickup', ['yes', 'no'])->default('no');
            $table->enum('status', ['1', '0'])->default('1')->comment('1: Active, 0: Inactive');
            $table->timestamps();

            $table->foreign('driver_id')->references('id')->on('driver')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alert');
    }
};
