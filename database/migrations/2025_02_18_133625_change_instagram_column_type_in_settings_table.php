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
        DB::statement('ALTER TABLE `settings` CHANGE `instagram` `instagram` VARCHAR(255) NULL DEFAULT NULL;');
    }

    public function down()
    {
        DB::statement('ALTER TABLE `settings` CHANGE `instagram` `instagram` INT NULL DEFAULT NULL;');
    }
};
