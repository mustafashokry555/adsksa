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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->index();
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->unsignedBigInteger('doctor_id')->index();
            $table->foreign('doctor_id')->references('id')->on('users')->cascadeOnDelete();
            $table->unsignedBigInteger('hospital_id')->index();
            $table->foreign('hospital_id')->references('id')->on('hospitals')->cascadeOnDelete();
            $table->string('star_rated', 1);
            $table->string('review_title');
            $table->string('review_body');
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
        Schema::dropIfExists('reviews');
    }
};
