<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // update city
        Schema::table('insurances', function (Blueprint $table) {
            $table->dropForeign(['city_id']);
            $table->unsignedBigInteger('state_id')->nullable()->after('city_id');
            $table->foreign('state_id')->references('id')->on('states')->onDelete('cascade');
        });
        DB::statement('UPDATE insurances SET state_id = city_id');
        Schema::table('insurances', function (Blueprint $table) {
            $table->dropColumn('city_id');
        });

        // update area
        Schema::table('insurances', function (Blueprint $table) {
            $table->dropForeign(['area_id']);
            $table->unsignedBigInteger('city_id')->nullable()->after('area_id');
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
        });
        DB::statement('UPDATE insurances SET city_id = area_id');
        Schema::table('insurances', function (Blueprint $table) {
            $table->dropColumn('area_id');
        });
    }

    public function down()
    {
        // city
        Schema::table('insurances', function (Blueprint $table) {
            $table->dropForeign(['state_id']);
            $table->unsignedBigInteger('city_id')->nullable()->after('state_id');
        });
        DB::statement('UPDATE insurances SET city_id = state_id');
        Schema::table('insurances', function (Blueprint $table) {
            $table->foreign('city_id')->references('id')->on('states')->onDelete('cascade');
            $table->dropColumn('state_id');
        });

        // area
        Schema::table('insurances', function (Blueprint $table) {
            $table->dropForeign(['city_id']);
            $table->unsignedBigInteger('area_id')->nullable()->after('city_id');
        });
        DB::statement('UPDATE insurances SET area_id = city_id');
        Schema::table('insurances', function (Blueprint $table) {
            $table->foreign('area_id')->references('id')->on('areas')->onDelete('cascade');
            $table->dropColumn('city_id');
        });
    }
};
