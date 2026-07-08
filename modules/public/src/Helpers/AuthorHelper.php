<?php

namespace Public\Helpers;

use App\Models\User;
use Illuminate\Database\Schema\Blueprint;

class AuthorHelper
{
    const fillable = ['author_id'];

    public static function setTableFields(Blueprint $table)
    {
        $table->foreignId('author_id')->nullable()->constrained('users')->nullOnDelete();
    }

    public static function dropTableFields(Blueprint $table)
    {
        $table->dropForeign([$table->getTable().'_author_id_foreign']);
        $table->dropColumn('author_id');
    }
    public static function authorRelation($model)
    {
        return $model->belongsTo(User::class, 'author_id');
    }
}
