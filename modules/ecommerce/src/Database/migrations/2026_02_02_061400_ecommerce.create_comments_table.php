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
        Schema::create('ecommerce_comments', function (Blueprint $table) {
            $commentStatus = \Public\Enums\CommentStatus::cases();
            $statusNames = [];
            foreach ($commentStatus as $status) {
                $statusNames[] = $status->name;
            }
            $table->id();
            $table->foreignId('product_id')->references('id')->on('ecommerce_products')->constrained()->cascadeOnDelete();
            $table->unsignedTinyInteger('stars')->default(5);
            $table->string('subject');
            $table->text('comment');
            $table->enum('status', $statusNames)->default(\Public\Enums\CommentStatus::Pending->name);
            $table->timestamps();
        });
    }

    /**
     *
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ecommerce_comments');
    }
};
