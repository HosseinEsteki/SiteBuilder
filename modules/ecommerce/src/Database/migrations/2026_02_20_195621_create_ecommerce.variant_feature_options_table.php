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
        Schema::create('ecommerce_variant_feature_options', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_variant_id')->constrained('ecommerce_product_variants')->cascadeOnDelete();
            $table->foreignId('feature_option_id')->constrained('ecommerce_feature_options')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ecommerce_variant_feature_options');
    }
};
