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
            Schema::table('assign_booking', function (Blueprint $table) {
                $table->string('online_amount')->nullable();
                $table->string('offline_amount')->nullable();
                $table->string('paymentInfoId')->nullable();
            });
        }

        /**
         * Reverse the migrations.
         */
        public function down(): void
        {
            Schema::table('assign_booking', function (Blueprint $table) {
                //
            });
        }
    };
