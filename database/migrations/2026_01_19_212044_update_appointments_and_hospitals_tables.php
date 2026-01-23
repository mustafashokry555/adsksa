<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        // Update appointments table
        DB::statement('ALTER TABLE appointments MODIFY appointment_time TIME NULL');

        // Update hospitals table
        Schema::table('hospitals', function (Blueprint $table) {
            $table->boolean('appointment_with_time')->default(true);
        });
    }

    public function down(): void
    {
        // Revert appointments table
        DB::statement('ALTER TABLE appointments MODIFY appointment_time TIME NOT NULL');

        // Revert hospitals table
        Schema::table('hospitals', function (Blueprint $table) {
            $table->dropColumn('appointment_with_time');
        });
    }
};
