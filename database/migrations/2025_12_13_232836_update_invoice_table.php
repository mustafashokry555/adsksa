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
        // make appointment_id  nullable using SQL (NO DBAL)
        DB::statement('ALTER TABLE invoices MODIFY hospital_id BIGINT UNSIGNED NULL;');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // revert appointment_id back to NOT NULL (optional)
        DB::statement('ALTER TABLE invoices MODIFY hospital_id BIGINT UNSIGNED NOT NULL;');
    }
};
