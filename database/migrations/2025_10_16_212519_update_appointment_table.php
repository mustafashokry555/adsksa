<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('appointments', function (Blueprint $table) {
            // First drop the old column
            $table->dropColumn('payment_date');
        });

        Schema::table('appointments', function (Blueprint $table) {
            // Then re-add it as timestamp
            $table->timestamp('payment_date')->nullable();
        });
    }

    public function down()
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->dropColumn('payment_date');
        });

        Schema::table('appointments', function (Blueprint $table) {
            $table->dateTime('payment_date')->nullable();
        });
    }
};
