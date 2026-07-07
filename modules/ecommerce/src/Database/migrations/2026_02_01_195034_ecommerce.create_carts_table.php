<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('ecommerce_carts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->timestamps();

            $table->index('user_id');

        });

        Schema::create('ecommerce_cart_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cart_id')->constrained()->references('id')->on('ecommerce_carts')->cascadeOnDelete();
            $table->foreignId('product_id')->references('id')->on('ecommerce_products')->constrained()->cascadeOnDelete();
            $table->unsignedInteger('quantity')->default(1);
            $table->timestamps();

            $table->index('cart_id');
            $table->index('product_id');
            $table->index('quantity');

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ecommerce_carts');
        Schema::dropIfExists('ecommerce_cart_items');
    }
};
