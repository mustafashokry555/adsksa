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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
//            Relations
            $table->unsignedBigInteger('hospital_id')->nullable();
            $table->foreign('hospital_id')->references('id')->on('hospitals');
            $table->unsignedBigInteger('speciality_id')->nullable();
            $table->foreign('speciality_id')->references('id')->on('specialities');
//            profile information
            $table->string('name');
            $table->string('username')->unique()->nullable();
            $table->string('profile_image')->nullable();
            $table->text('description')->nullable();
            $table->string('address')->nullable();
            $table->string('country')->nullable();
            $table->string('state')->nullable();
            $table->string('zip_code')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('gender')->nullable();
            $table->integer('age')->nullable();
            $table->string('blood_group')->nullable();
            $table->string('email')->unique();
            $table->string('mobile')->nullable();
            $table->string('user_type', 1)->default('U');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('pricing')->nullable();
            $table->string('password')->default(bcrypt('12345678'));
//            Doctor Details
//            $table->string('clinic_name')->nullable();
//            $table->string('clinic_address')->nullable();
//            $table->string('clinic_image')->nullable();
//            $table->string('pricing')->nullable();
//            education
//            $table->string('degree')->nullable();
//            $table->string('college')->nullable();
//            $table->date('graduation_year')->nullable();
//            Experience
//            $table->string('hospital_name')->nullable();
//            $table->date('start_date')->nullable();
//            $table->date('end_date')->nullable();
//            $table->string('designation')->nullable();
//            social links
            $table->string('twitter')->nullable();
            $table->string('facebook')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('pinterest')->nullable();
            $table->string('instagram')->nullable();
            $table->string('youtube')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
