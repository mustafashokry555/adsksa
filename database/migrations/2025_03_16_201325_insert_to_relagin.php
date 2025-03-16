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
        $religions = [
            ['name_ar' => 'الإسلام', 'name_en' => 'Islam', 'created_at' => now(), 'updated_at' => now()],
            ['name_ar' => 'المسيحية', 'name_en' => 'Christianity', 'created_at' => now(), 'updated_at' => now()],
            ['name_ar' => 'أخرى', 'name_en' => 'Other', 'created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('religions')->insert($religions);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
};
