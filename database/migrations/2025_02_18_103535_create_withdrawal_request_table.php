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
        Schema::create('withdrawal_request', function (Blueprint $table) {
            $table->id();
            $table->string('driver_id')->nullable();
            $table->string('amount')->nullable();
            $table->enum('status', ['0', '1', '2'])->default('0')->comment('0:initiate,1:approved,2:reject');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('withdrawal_request');
    }
};
