<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('theme_templates', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('theme_id')->nullable()->constrained('theme_themes')->nullOnDelete();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('type');
            $table->json('builder_data')->nullable();
            $table->longText('custom_css')->nullable();
            $table->string('status')->default('draft');
            $table->boolean('is_default')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('theme_templates');
    }
};
