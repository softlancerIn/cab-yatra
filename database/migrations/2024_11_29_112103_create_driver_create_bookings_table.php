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
        Schema::create('driver_create_bookings', function (Blueprint $table) {
            $table->id();
            $table->string('car_category_id')->nullable();
            $table->string('fuel_type')->nullable();
            $table->enum('trip_type', ['0', '1', '2', '3'])->default('0')->comment('0:round trip, 1:one way, 2:airport, 3:local trip');
            $table->string('pickup_address')->nullable();
            $table->string('destination_address')->nullable();
            $table->string('time_schaduleId')->nullable();
            $table->string('start_date')->nullable();
            $table->string('start_time')->nullable();
            $table->string('end_date')->nullable();
            $table->string('end_time')->nullable();
            $table->string('total_km')->nullable();
            $table->string('extra_price_perKm')->nullable();
            $table->string('toll')->nullable();
            $table->string('tax')->nullable();
            $table->string('total_amount')->nullable();
            $table->string('comission')->nullable();
            $table->string('add_on_service')->nullable()->comment('add on service as carrier');
            $table->enum('is_show_phoneNumber', ['0', '1'])->default('0')->comment('0:Not Show, 1:Show phone number');
            $table->string('special_requirment')->nullable();
            $table->enum('status', ['0', '1', '2', '3'])->default('0')->comment('0:Initiated, 1:Accepted, 2:Completed, 3:Rejected');
            $table->enum('is_driver_accepted', ['0', '1'])->default('0')->comment('0:Not Accpted, 1:Accepted');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('driver_create_bookings');
    }
};
