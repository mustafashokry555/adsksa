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
        Schema::create('religions', function (Blueprint $table) {
            $table->id();
            $table->string('name_ar'); // Arabic name
            $table->string('name_en'); // English name
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('religions');
    }
    
    /**
     * Seed the religions table with common religions.
     *
     * @return void
     */
    private function seedReligions()
    {
        $religions = [
            ['name_ar' => 'الإسلام', 'name_en' => 'Islam'],
            ['name_ar' => 'المسيحية', 'name_en' => 'Christianity'],
            ['name_ar' => 'أخرى', 'name_en' => 'Other'],
        ];
        
        DB::table('religions')->insert($religions);
    }
};
