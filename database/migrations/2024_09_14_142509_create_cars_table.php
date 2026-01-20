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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('unique_number')->unique();
            $table->string('name')->nullable();
            $table->enum('type', ['ac', 'non_ac'])->default('non_ac');
            $table->enum('fuel_type', ['petrol', 'diesel', 'electric', 'hybrid', 'cng', 'lpg', 'other'])->default('other'); // enum for fuel_type
            $table->enum('category', ['sedan', 'hatchback', 'suv', 'coupe', 'convertable', 'crossover', 'other'])->default('other'); // enum for category
            $table->string('image')->nullable();
            $table->string('min_charge')->nullable();
            $table->string('car_number')->nullable();
            $table->string('other_details')->nullable();
            $table->enum('is_available', ['0', '1'])->default('1')->comment('0: Unavailable, 1: Available');
            $table->enum('status', ['0', '1'])->default('1');
            $table->timestamps();

            // Indexes
            // $table->unique('unique_number'); // unique index for unique_number
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
