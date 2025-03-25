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
        foreach (['hospitals', 'users', 'insurances'] as $table) {
            Schema::table($table, function (Blueprint $table) {
                if (Schema::hasColumn($table->getTable(), 'country')) {
                    $table->dropColumn('country');
                }
                if (Schema::hasColumn($table->getTable(), 'state')) {
                    $table->dropColumn('state');
                }
                if (Schema::hasColumn($table->getTable(), 'city')) {
                    $table->dropColumn('city');
                }
            });
        }
    }

    public function down()
    {
        foreach (['hospitals', 'users', 'insurances'] as $table) {
            Schema::table($table, function (Blueprint $table) {
                $table->string('country')->nullable();
                $table->string('state')->nullable();
                $table->string('city')->nullable();
            });
        }
    }
};
