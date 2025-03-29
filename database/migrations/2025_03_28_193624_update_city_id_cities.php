<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('cities', function (Blueprint $table) {
            $table->dropForeign('areas_city_id_foreign');
            $table->unsignedBigInteger('state_id')->nullable()->after('city_id');
            $table->foreign('state_id')->references('id')->on('states')->onDelete('cascade');
        });
        DB::statement('UPDATE cities SET state_id = city_id');
        Schema::table('cities', function (Blueprint $table) {
            $table->dropColumn('city_id');
        });
    }

    public function down()
    {
        Schema::table('cities', function (Blueprint $table) {
            $table->dropForeign(['state_id']);
            $table->unsignedBigInteger('city_id')->nullable()->after('state_id');
        });
        DB::statement('UPDATE cities SET city_id = state_id');
        Schema::table('cities', function (Blueprint $table) {
            $table->foreign('city_id')->references('id')->on('states')->onDelete('cascade');
            $table->dropColumn('state_id');
        });
    }
};
