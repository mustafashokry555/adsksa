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
        Schema::table('notifications', function (Blueprint $table) {
            // Add user_id column
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
            
            // Add title columns
            $table->string('title_en')->after('user_id');
            $table->string('title_ar')->after('title_en');
            
            // Rename message to message_en and add message_ar
            $table->renameColumn('message', 'message_en');
            $table->string('message_ar');

            // Drop the old foreign key and column
            $table->dropForeign(['appointment_id']);
            $table->dropColumn('appointment_id');

            // Add polymorphic columns
            $table->string('notifiable_type')->nullable();
            $table->unsignedBigInteger('notifiable_id')->nullable();
            $table->index(['notifiable_type', 'notifiable_id']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('notifications', function (Blueprint $table) {
            // Drop foreign key first
            $table->dropForeign(['user_id']);
            
            // Drop columns
            $table->dropColumn('user_id');
            $table->dropColumn('title_en');
            $table->dropColumn('title_ar');
            $table->renameColumn('message_en', 'message');
            $table->dropColumn('message_ar');

            // Drop polymorphic columns
            $table->dropIndex(['notifiable_type', 'notifiable_id']);
            $table->dropColumn('notifiable_type');
            $table->dropColumn('notifiable_id');

            // Restore original appointment_id column
            $table->unsignedBigInteger('appointment_id')->nullable();
            $table->foreign('appointment_id')->references('id')->on('appointments')->cascadeOnDelete();
        });
    }
};
