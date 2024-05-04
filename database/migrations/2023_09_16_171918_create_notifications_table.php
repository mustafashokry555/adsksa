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
        Schema::create('notifications', function (Blueprint $table) {
            
            $table->id();
            $table->unsignedBigInteger('appointment_id')->nullable();
            $table->foreign('appointment_id')->references('id')->on('appointments')->cascadeOnDelete();
            $table->unsignedBigInteger('from_id')->nullable();
            $table->foreign('from_id')->references('id')->on('users')->cascadeOnDelete();
            $table->unsignedBigInteger('to_id')->nullable();
            $table->foreign('to_id')->references('id')->on('users')->cascadeOnDelete();;
            $table->string('message');
            $table->integer('isRead')->default(1);
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
        Schema::dropIfExists('notifications');
    }
};
