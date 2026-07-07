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
        Schema::table('ecommerce_categories', function (Blueprint $table) {
            \Public\Helpers\AuthorHelper::setTableFields($table);
        });
        Schema::table('ecommerce_products', function (Blueprint $table) {
            \Public\Helpers\AuthorHelper::setTableFields($table);
        });
        Schema::table('ecommerce_comments', function (Blueprint $table) {
            \Public\Helpers\AuthorHelper::setTableFields($table);
        });
        Schema::table('ecommerce_brands', function (Blueprint $table) {
            \Public\Helpers\AuthorHelper::setTableFields($table);
        });
        Schema::table('ecommerce_discounts', function (Blueprint $table) {
            \Public\Helpers\AuthorHelper::setTableFields($table);
        });
        Schema::table('ecommerce_shippings', function (Blueprint $table) {
            \Public\Helpers\AuthorHelper::setTableFields($table);
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ecommerce_categories', function (Blueprint $table) {
            \Public\Helpers\AuthorHelper::dropTableFields($table);
        });
        Schema::table('ecommerce_products', function (Blueprint $table) {
            \Public\Helpers\AuthorHelper::dropTableFields($table);
        });
        Schema::table('ecommerce_brands', function (Blueprint $table) {
            \Public\Helpers\AuthorHelper::dropTableFields($table);
        });
        Schema::table('ecommerce_comments', function (Blueprint $table) {
            \Public\Helpers\AuthorHelper::dropTableFields($table);
        });
    }
};
