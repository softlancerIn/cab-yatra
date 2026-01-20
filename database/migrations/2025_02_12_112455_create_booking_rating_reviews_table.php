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
        Schema::create('booking_rating_reviews', function (Blueprint $table) {
            $table->id();
            $table->string('booking_id')->nullable();
            $table->string('rating')->nullable();
            $table->string('checkBox_review')->nullable();
            $table->string('text_review')->nullable();
            $table->enum('status', ['1', '0'])->default('1')->comment('1:Active, 0:Inactive');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_rating_reviews');
    }
};
