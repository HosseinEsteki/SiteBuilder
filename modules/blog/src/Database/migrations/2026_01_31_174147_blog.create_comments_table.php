<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Public\Enums\CommentStatus;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('blog_comments', function (Blueprint $table) {
            $statusValues = CommentStatus::values();
            $table->id();
            $table->foreignId('article_id')->references('id')->on('blog_articles')->constrained()->cascadeOnDelete();
            $table->string('subject');
            $table->text('comment');
            $table->enum('status', $statusValues)->default(CommentStatus::Pending->value);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('blog_comments');
    }
};
