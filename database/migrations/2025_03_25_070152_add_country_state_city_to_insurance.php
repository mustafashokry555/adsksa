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
        Schema::table('insurances', function (Blueprint $table) {
            $table->unsignedBigInteger('country_id')->nullable();
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('set null');
            $table->unsignedBigInteger('city_id')->nullable();
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('set null');
            $table->unsignedBigInteger('area_id')->nullable();
            $table->foreign('area_id')->references('id')->on('areas')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('insurances', function (Blueprint $table) {
            $table->dropForeign(['country_id']); // Drop the foreign key
            $table->dropColumn('country_id');   // Drop the column
            $table->dropForeign(['city_id']); // Drop the foreign key
            $table->dropColumn('city_id');   // Drop the column
            $table->dropForeign(['area_id']); // Drop the foreign key
            $table->dropColumn('area_id');   // Drop the column
        });
    }
};
