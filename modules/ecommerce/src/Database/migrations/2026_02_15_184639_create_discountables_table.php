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
        Schema::create('ecommerce_discountables', function (Blueprint $table) {
            $table->id();
            $table->foreignId('discount_id')->constrained('ecommerce_discounts')->onDelete('cascade');
            $table->morphs('discountable'); // می‌تونه product یا category باشه
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ecommerce_discountables');
    }
};
