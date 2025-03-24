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
        Schema::table('hospitals', function (Blueprint $table) {
            $table->unsignedBigInteger('area_id')->nullable()->after('city_id'); // Add city_id column
            $table->foreign('area_id')->references('id')->on('areas')->onDelete('set null'); // Add foreign key constraint
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hospitals', function (Blueprint $table) {
            $table->dropForeign(['area_id']); // Drop the foreign key
            $table->dropColumn('area_id');   // Drop the column
        });
    }
};
