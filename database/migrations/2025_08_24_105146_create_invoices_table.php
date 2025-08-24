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
    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();

            // Relations
            $table->foreignId('appointment_id')->constrained()->onDelete('cascade');
            $table->foreignId('doctor_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('patient_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('hospital_id')->constrained()->onDelete('cascade');

            // Invoice Info
            $table->string('invoice_number')->unique();
            $table->string('company_name')->nullable();
            $table->string('company_address')->nullable();
            $table->dateTime('invoice_date')->nullable();
            $table->string('tax_number')->nullable();

            // Totals
            $table->float('subtotal', 10, 2);
            $table->float('vat', 10, 2);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
