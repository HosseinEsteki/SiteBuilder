<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('theme_pages', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('theme_id')->nullable()->constrained('theme_themes')->nullOnDelete();
            $table->foreignId('template_id')->nullable()->constrained('theme_templates')->nullOnDelete();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('excerpt')->nullable();
            $table->json('builder_data')->nullable();
            $table->longText('custom_css')->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('status')->default('draft');
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('theme_pages');
    }
};
