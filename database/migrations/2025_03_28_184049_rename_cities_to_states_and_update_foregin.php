<?php

use Illuminate\Database\Migrations\Migration;
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
        Schema::rename('cities', 'states');
        DB::statement('ALTER TABLE `arabcare`.`states` RENAME INDEX `cities_country_id_foreign` TO `states_country_id_foreign`;');

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::rename('states', 'cities');
        DB::statement('ALTER TABLE `arabcare`.`cities` RENAME INDEX `states_country_id_foreign` TO `cities_country_id_foreign` ;');
    }
};
