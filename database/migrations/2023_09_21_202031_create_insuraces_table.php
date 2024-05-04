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
        Schema::create('insurances', function (Blueprint $table) {
            $table->id(); // Auto-incremental primary key
            $table->unsignedBigInteger('user_id')->nullable(); //if null then created by admin  else master hospital id not user id 
            $table->string('name'); // Insurance company name
            $table->string('city')->nullable(); // Address of the company
            $table->string('state')->nullable(); // Address of the company
            $table->string('address')->nullable(); // Address of the company
            $table->string('phone1')->nullable(); // Phone number
            $table->string('phone2')->nullable(); // Phone number
            $table->string('fax')->nullable(); // Phone number
            $table->string('email')->nullable(); // Email address
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();

            $table->timestamps(); // Created at and updated at timestamps
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('insuraces');
    }
};
