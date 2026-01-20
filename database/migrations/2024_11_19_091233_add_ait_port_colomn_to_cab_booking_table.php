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
