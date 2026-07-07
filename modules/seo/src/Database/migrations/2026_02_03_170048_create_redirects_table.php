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
        Schema::create('seo_redirects', function (Blueprint $table) {
            $table->id();
            $table->string('from')->unique();   // مسیر قدیمی
            $table->string('to');               // مسیر جدید
            $table->unsignedSmallInteger('status_code')->default(301); // نوع ریدایرکت
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('seo_redirects', function (Blueprint $table) {
            //
        });
    }
};
