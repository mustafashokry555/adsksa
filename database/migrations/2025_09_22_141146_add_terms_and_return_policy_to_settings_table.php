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
        Schema::table('settings', function (Blueprint $table) {
            $table->text('terms_ar')->nullable();
            $table->text('terms_en')->nullable();
            $table->text('return_policy_ar')->nullable();
            $table->text('return_policy_en')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn(['terms_ar', 'terms_en', 'return_policy_ar', 'return_policy_en']);
        });
    }
};
