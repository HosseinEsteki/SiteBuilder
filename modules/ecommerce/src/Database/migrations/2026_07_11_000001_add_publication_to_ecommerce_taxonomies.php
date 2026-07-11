<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void { Schema::table('ecommerce_categories', fn (Blueprint $t) => $t->boolean('is_published')->default(true)->index()); Schema::table('ecommerce_brands', fn (Blueprint $t) => $t->boolean('is_published')->default(true)->index()); }
    public function down(): void { Schema::table('ecommerce_categories', fn (Blueprint $t) => $t->dropColumn('is_published')); Schema::table('ecommerce_brands', fn (Blueprint $t) => $t->dropColumn('is_published')); }
};
