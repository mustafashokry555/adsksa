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
        Schema::create('offer_types', function (Blueprint $table) {
            $table->id();
            $table->string('name_ar');
            $table->string('name_en');
            $table->string('image')->nullable(); // Path or filename
            $table->boolean('status')->default(1); // 1 = active, 0 = inactive
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('offer_types');
    }
};
