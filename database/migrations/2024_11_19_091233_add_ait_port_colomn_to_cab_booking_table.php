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
        Schema::table('cabBooking', function (Blueprint $table) {
            $table->enum('is_airpotToFrom', ['0', '1'])->default('1')->comment('0: To Airport, 1: From Airport');

            $table->string('driver_comission')->nullable()->after('total_faire');

            // Payment split
            $table->string('online_payment')->default('0')->after('payment_infoId');
            $table->string('offline_payment')->default('0')->after('online_payment');

            // UI toggles
            $table->enum('is_show_phoneNumber', ['0', '1'])->default('1')->after('status');

            // Round trip
            $table->integer('number_of_days')->nullable()->after('destination_time');

            // Notes
            $table->text('remark')->nullable()->after('add_onService');

            // Booking meta
            $table->enum('is_driver_createBooking', ['0', '1'])->default('0');
            $table->enum('is_assigned', ['0', '1'])->default('0');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cabBooking', function (Blueprint $table) {
            //
        });
    }
};
