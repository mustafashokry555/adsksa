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
        Schema::create('otps', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->index()->nullable(); // Link to users table
            $table->string('email')->nullable()->index(); // In case OTP is sent before account creation
            $table->string('otp', 6); // OTP code (max 6 digits/characters)
            $table->timestamp('expires_at'); // Expiry time
            $table->boolean('is_used')->default(false); // Mark if already used
            $table->string('reason')->nullable();
            $table->timestamps();

            // Optional foreign key
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('otps');
    }
};
