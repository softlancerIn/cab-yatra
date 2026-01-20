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
        Schema::table('cab_airport_fairs', function (Blueprint $table) {
            $table->enum('type', ['1', '0'])->default('1')->comment('1:One way, 0: Airport');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cab_airport_fairs', function (Blueprint $table) {
            //
        });
    }
};
