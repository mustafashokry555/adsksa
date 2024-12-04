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
        Schema::table('hospitals', function (Blueprint $table) {
            DB::statement("ALTER TABLE hospitals MODIFY address VARCHAR(100) NULL");
            DB::statement("ALTER TABLE hospitals MODIFY city VARCHAR(100) NULL");
            DB::statement("ALTER TABLE hospitals MODIFY country VARCHAR(100) NULL");
            DB::statement("ALTER TABLE hospitals MODIFY state VARCHAR(100) NULL");
            DB::statement("ALTER TABLE hospitals MODIFY zip VARCHAR(100) NULL");
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
            DB::statement("ALTER TABLE hospitals MODIFY address VARCHAR(100) NOT NULL");
        DB::statement("ALTER TABLE hospitals MODIFY city VARCHAR(100) NOT NULL");
        DB::statement("ALTER TABLE hospitals MODIFY country VARCHAR(100) NOT NULL");
        DB::statement("ALTER TABLE hospitals MODIFY state VARCHAR(100) NOT NULL");
        DB::statement("ALTER TABLE hospitals MODIFY zip VARCHAR(100) NOT NULL");
        });
    }
};
