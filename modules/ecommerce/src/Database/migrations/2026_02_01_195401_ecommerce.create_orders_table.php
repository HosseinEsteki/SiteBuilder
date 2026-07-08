<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Ecommerce\Enums\OrderStatus;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('ecommerce_orders', function (Blueprint $table) {
            $table->id();

            // ارتباط با کاربر
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            // وضعیت سفارش با استفاده از Enum
            $table->enum('status', OrderStatus::values())
                ->default(OrderStatus::Pending->value);

            // مبالغ
            $table->unsignedBigInteger('original_total')->default(0);
            $table->unsignedBigInteger('total_price')->default(0);
            $table->unsignedBigInteger('discount')->default(0);

            // ارسال
            $table->unsignedBigInteger('total_shipping')->default(0)->nullable();
            $table->text('shipping_address')->nullable();
            $table->text('shipping_code')->nullable();
            $table->text('shipping_user')->nullable();

            $table->text('description')->nullable();

            // اطلاعات پرداخت
            $table->string('payment_ref')->nullable();

            $table->timestamps();

            // ایندکس‌ها
            $table->index('user_id');
            $table->index('status');
            $table->index('payment_ref');
        });

        Schema::create('ecommerce_order_items', function (Blueprint $table) {
            $table->id();

            // ارتباط با سفارش و محصول
            $table->foreignId('order_id')->constrained('ecommerce_orders')->cascadeOnDelete();
            $table->foreignId('product_id')->constrained('ecommerce_products')->cascadeOnDelete();

            // جزئیات آیتم
            $table->unsignedInteger('quantity')->default(1);
            $table->decimal('price', 15, 2);

            $table->timestamps();

            // ایندکس‌ها
            $table->index('order_id');
            $table->index('product_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ecommerce_order_items');
        Schema::dropIfExists('ecommerce_orders');
    }
};
