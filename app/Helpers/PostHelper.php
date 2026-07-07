<?php

namespace App\Helpers;

use Illuminate\Database\Schema\Blueprint;
use Public\Enums\PostStatus;

class PostHelper
{
    const fillable = ['name', 'slug', 'status', 'content', 'category_id'];
    const appends = ['show_content'];

    public static function setTableFields(Blueprint $table, $categoryTableName)
    {
        $table->string('name');
        $table->string('slug')->unique();
        $table->json('content');
        $table->foreignId('category_id')->references('id')->on($categoryTableName)->nullable()->constrained();
        $table->enum('status', PostStatus::getNames())->default(PostStatus::Draft->name);
    }


}
