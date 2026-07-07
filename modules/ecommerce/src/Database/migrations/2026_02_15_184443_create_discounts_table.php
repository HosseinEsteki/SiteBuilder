<?php

use Ecommerce\Enums\DiscountType;
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
        Schema::create('ecommerce_discounts', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // عنوان تخفیف
            $table->enum('type', DiscountType::getValues()); // نوع تخفیف
            $table->json('conditions')->nullable(); // شرایط تخفیف
            $table->decimal('value', 10, 2)->nullable(); // درصد یا مبلغ ثابت
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->integer('usage_limit')->nullable(); // محدودیت تعداد استفاده
            $table->integer('used_count')->default(0); // تعداد استفاده شده
            $table->boolean('active')->default(true);
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('discounts');
    }
};
