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
        Schema::table('blogs', function (Blueprint $table) {
            // Add new column after renamed column
            $table->string('blog_title_ar')->nullable()->after('blog_title');
            $table->string('blog_body_ar')->nullable()->after('blog_body');
            // Rename column
            $table->renameColumn('blog_title', 'blog_title_en');
            $table->renameColumn('blog_body', 'blog_body_en');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
