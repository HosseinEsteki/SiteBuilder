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
        Schema::create('ecommerce_feature_options', function (Blueprint $table) {
            $table->id();
            $table->foreignId('feature_id')->constrained('ecommerce_features')->cascadeOnDelete();
            $table->string('value'); // قرمز، آبی
            $table->string('slug');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ecommerce_feature_options');
    }
};
