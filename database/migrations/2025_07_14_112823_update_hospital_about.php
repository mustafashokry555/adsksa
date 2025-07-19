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
            // Remove 'about2'
            $table->dropColumn('about2');

            // Rename columns
            $table->renameColumn('about1', 'about_ar');
            $table->renameColumn('about', 'about_en');
        });
    }

    public function down()
    {
        Schema::table('hospitals', function (Blueprint $table) {
            // Restore 'about2'
            $table->text('about2')->nullable();

            // Rename back
            $table->renameColumn('about_ar', 'about1');
            $table->renameColumn('about_en', 'about');
        });
    }
};
