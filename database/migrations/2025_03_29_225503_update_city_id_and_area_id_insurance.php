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
            $table->dropForeign('insurances_country_id_foreign');
            $table->dropForeign('insurances_state_id_foreign');
            $table->dropForeign('insurances_city_id_foreign');

            // 3. Re-add the foreign key with onDelete('set null')
            $table->foreign('country_id')
                ->references('id')
                ->on('countries')
                ->onDelete('set null');
            $table->foreign('state_id')
                ->references('id')
                ->on('states')
                ->onDelete('set null');
            
            $table->foreign('city_id')
                ->references('id')
                ->on('cities')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
