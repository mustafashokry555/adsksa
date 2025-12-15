<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        // make appointment_id  nullable using SQL (NO DBAL)
        DB::statement('ALTER TABLE invoices MODIFY appointment_id BIGINT UNSIGNED NULL;');
        Schema::table('invoices', function (Blueprint $table) {
            // add offer_id
            $table->unsignedBigInteger('cart_id')->nullable()->after('appointment_id');
            $table->foreign('cart_id')->references('id')->on('carts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('invoices', function (Blueprint $table) {
            $table->dropForeign(['cart_id']);
            $table->dropColumn('cart_id');
        });

        // revert appointment_id back to NOT NULL (optional)
        DB::statement('ALTER TABLE invoices MODIFY appointment_id BIGINT UNSIGNED NOT NULL;');
    }
};
