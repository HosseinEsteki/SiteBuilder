<?php

namespace App\Helpers;

use Illuminate\Database\Schema\Blueprint;

class SeoHelper
{
    public static $fillable = ['keywords', 'description'];
    public static function setTableFields(Blueprint $table)
    {
        $table->json('keywords')->nullable();
        $table->text('description')->nullable();
    }
}
