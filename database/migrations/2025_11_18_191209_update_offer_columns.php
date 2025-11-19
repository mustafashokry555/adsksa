<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // unavailabilities table
        Schema::table('unavailabilities', function (Blueprint $table) {
            $table->unsignedBigInteger('offer_id')->nullable();
            $table->foreign('offer_id')->references('id')->on('offers')->onDelete('set null');
        });

        // appointments table
        // make doctor_id nullable using SQL (NO DBAL)
        DB::statement('ALTER TABLE appointments MODIFY doctor_id BIGINT UNSIGNED NULL;');
        Schema::table('appointments', function (Blueprint $table) {
            // add offer_id
            $table->unsignedBigInteger('offer_id')->nullable()->after('doctor_id');
            $table->foreign('offer_id')->references('id')->on('offers')->onDelete('set null');
        });

        // regular_availabilities table
        Schema::table('regular_availabilities', function (Blueprint $table) {
            $table->unsignedBigInteger('offer_id')->nullable()->after('id');
            $table->foreign('offer_id')->references('id')->on('offers')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('unavailabilities', function (Blueprint $table) {
            $table->dropForeign(['offer_id']);
            $table->dropColumn('offer_id');
        });

        Schema::table('appointments', function (Blueprint $table) {
            $table->dropForeign(['offer_id']);
            $table->dropColumn('offer_id');
        });

        // revert doctor_id back to NOT NULL (optional)
        DB::statement('ALTER TABLE appointments MODIFY doctor_id BIGINT UNSIGNED NOT NULL;');


        Schema::table('regular_availabilities', function (Blueprint $table) {
            $table->dropForeign(['offer_id']);
            $table->dropColumn('offer_id');
        });
    }
};
