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
        Schema::table('car_category', function (Blueprint $table) {
            $table->string('toll')->nullable();
            $table->string('tax')->nullable();
            $table->string('parking')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('car_category', function (Blueprint $table) {
            //
        });
    }
};
