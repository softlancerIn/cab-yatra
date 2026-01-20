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
        Schema::create('driver_payment_method', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['1', '0'])->default('1')->comment('1:bank service,0:upi');
            $table->string('bank_name')->nullable();
            $table->string('account_number')->nullable();
            $table->string('ifsc_code')->nullable();
            $table->string('account_holderName')->nullable();
            $table->string('upi_id')->nullable();
            $table->string('payment_number')->nullable();
            $table->string('qr_image')->nullable();
            $table->enum('status', ['1', '0'])->default('1')->comment('1:Active,0:Inactive');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('driver_payment_method');
    }
};
