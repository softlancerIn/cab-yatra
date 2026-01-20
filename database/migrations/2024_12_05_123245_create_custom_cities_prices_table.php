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
        Schema::create('custom_cities_prices', function (Blueprint $table) {
            $table->id();
            $table->string('pickup_loc');
            $table->string('destination_loc');
            $table->string('total_km');
            $table->string('total_fair');
            $table->string('toll');
            $table->string('driver_charge');
            $table->string('night_charge');
            $table->string('extra_fair_perKm');
            $table->string('parking_charge');
            $table->string('other_details');
            $table->enum('status', ['0', '1'])->default('1')->comment('0:Active, 1:Inactive');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('custom_cities_prices');
    }
};
