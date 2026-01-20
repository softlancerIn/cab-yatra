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
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('to')->nullable();
            $table->string('from')->nullable();
            $table->string('distance');
            $table->string('per_km_cost')->nullable();
            $table->string('total_price')->nullable();
            $table->string('discount')->nullable();
            $table->string('other_details')->nullable();
            $table->enum('status', ['0', '1'])->default('1')->comment('0: Inactive, 1: Active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};
