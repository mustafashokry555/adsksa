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
        Schema::table('hospitals', function (Blueprint $table) {
            $table->foreignId('hospital_type_id')->nullable()->constrained('hospital_types')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('hospitals', function (Blueprint $table) {
            $table->dropForeign(['hospital_type_id']);
            $table->dropColumn('hospital_type_id');
        });
    }
};
