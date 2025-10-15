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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('invoice_id')->nullable()->constrained()->nullOnDelete();
            $table->string('merchant_reference')->nullable()->index(); // your internal reference
            $table->string('paytabs_transaction_id')->nullable()->index(); // paytabs transaction id
            $table->string('paytabs_invoice_id')->nullable()->index(); // paytabs transaction id
            $table->double('amount', 12, 2);
            $table->string('currency', 10)->default('USD');
            $table->string('status')->default('pending'); // pending, paid, failed, cancelled, refunded
            $table->string('payment_page_url')->nullable();
            $table->json('response_payload')->nullable(); // raw response JSON
            $table->timestamp('paid_at')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('payments');
    }
};
