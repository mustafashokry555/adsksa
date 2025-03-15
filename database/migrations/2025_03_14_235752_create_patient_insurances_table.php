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
        Schema::create('patient_insurances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('insurance_id')->constrained('insurances')->onDelete('cascade');
            $table->string('medical_network');
            // $table->string('id_card_number');
            $table->string('category');
            $table->decimal('co_payment_percentage', 5, 2);
            $table->date('submission_date');
            $table->string('subscriber_type');
            $table->string('insurance_policy_number');
            // $table->string('gender');
            $table->text('coverage_limits');
            $table->date('insurance_expiry_date');
            $table->string('subscriber_number');
            $table->timestamps();
            
        });
    }

    public function down()
    {
        Schema::dropIfExists('patient_insurances');
    }
};
