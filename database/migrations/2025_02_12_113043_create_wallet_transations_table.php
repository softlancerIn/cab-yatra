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
        Schema::create('wallet_transations', function (Blueprint $table) {
            $table->id();
            $table->string('driver_id')->nullable();
            $table->string('amount');
            $table->string('transaction_id');
            $table->string('razorpayId')->nullable();
            $table->enum('type', ['1', '0'])->default('1')->comment('1:credit, 0:debit');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wallet_transations');
    }
};
