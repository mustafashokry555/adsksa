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
        Schema::create('one_time_availabilities', function (Blueprint $table) {
            $table->id();
            $table->date("date")->nullable();
            $table->integer("time_interval")->default(15);
            $table->text('slots')->nullable();
            $table->integer('hospital_id')->nullable();
            $table->unsignedBigInteger('doctor_id')->nullable();
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
        Schema::dropIfExists('one_time_availabilities');
    }
};
