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
        Schema::create('seo', function (Blueprint $table) {
            $table->id();
            $table->string('page_url')->nullable();
            $table->string('title')->nullable();
            $table->string('keyword')->nullable();
            $table->string('description')->nullable();
            $table->string('script')->nullable();
            $table->enum('status', ['1', '0'])->default(1)->comment('1:Active,0:Inactive');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seo');
    }
};
