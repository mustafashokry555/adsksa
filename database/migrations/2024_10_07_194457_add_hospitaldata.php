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
            $table->dropColumn(['location', 'long', 'lat', 'about1', 'about2', 'about', 'opening_hours']);
        });
        Schema::table('hospitals', function (Blueprint $table) {
            $table->string('location')->nullable();
            $table->double('long', 20, 15)->nullable();
            $table->decimal('lat', 20, 15)->nullable();
            $table->text('about')->nullable();
            $table->text('about1')->nullable();
            $table->text('about2')->nullable();
            $table->string('opening_hours')->nullable(); // For hospital opening times like 24/7
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
            $table->dropColumn(['location', 'long', 'lat', 'about1', 'about2', 'about', 'opening_hours']);
        });
    }
};
