<?php

use App\Helpers\PostHelper;
use App\Helpers\SeoHelper;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('ecommerce_products', function (Blueprint $table) {
            $table->id();
            PostHelper::setTableFields($table, 'ecommerce_categories');
            SeoHelper::setTableFields($table);
            // برای محصول ساده
            $table->unsignedBigInteger('price')->nullable();
            $table->unsignedBigInteger('sale_price')->nullable();
            $table->unsignedInteger('stock')->nullable();
            // اگر محصول متغیر باشد، price و stock از Variant می‌آید
            $table->boolean('is_variable')->default(false);
            $table->foreignId('brand_id')->nullable()->constrained('ecommerce_brands')->nullOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ecommerce_products');
    }
};
