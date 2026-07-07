<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('blog_articles', function (Blueprint $table) {
            \Public\Helpers\AuthorHelper::setTableFields($table);
        });
        Schema::table('blog_categories', function (Blueprint $table) {
            \Public\Helpers\AuthorHelper::setTableFields($table);});
        Schema::table('blog_comments', function (Blueprint $table) {
            \Public\Helpers\AuthorHelper::setTableFields($table);});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        schema::table('blog_articles', function (Blueprint $table) {
            \Public\Helpers\AuthorHelper::dropTableFields($table);
        });
        Schema::table('blog_categories', function (Blueprint $table) {
            \Public\Helpers\AuthorHelper::dropTableFields($table);
        });
        Schema::table('blog_comments', function (Blueprint $table) {
            \Public\Helpers\AuthorHelper::dropTableFields($table);
        });
    }
};
