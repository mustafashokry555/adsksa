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
        Schema::create('regular_availabilities', function (Blueprint $table) {
            $table->id();
            $table->integer("time_interval")->default(15);
            $table->enum('week_day', [
                'monday',
                'tuesday',
                'wednesday',
                'thursday',
                'friday',
                'saturday',
                'sunday'
            ]);
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
        Schema::dropIfExists('regular_availabilities');
    }
};
