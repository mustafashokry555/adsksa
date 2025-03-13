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
            $table->double('new_lat', 20, 15)->nullable();
        });

        // Copy existing data
        DB::statement('UPDATE hospitals SET new_lat = lat');

        Schema::table('hospitals', function (Blueprint $table) {
            $table->dropColumn('lat');
            $table->renameColumn('new_lat', 'lat');
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
            $table->decimal('old_lat', 20, 15)->nullable();
        });

        // Copy data back
        DB::statement('UPDATE hospitals SET old_lat = lat');

        Schema::table('hospitals', function (Blueprint $table) {
            $table->dropColumn('lat');
            $table->renameColumn('old_lat', 'lat');
        });
    }
};
