<?php

namespace Public\Traits;

use Illuminate\Support\Facades\Auth;
use Public\Helpers\AuthorHelper;

trait HasAuthor
{
    public function initializeHasAuthor()
    {
        $this->mergeFillable(AuthorHelper::fillable);
    }
    protected static function bootHasAuthor()
    {


        static::creating(function ($model) {
            if (! Auth::check()) {
                return;
            }

                $model->author_id = Auth::id();
        });


        static::updating(function ($model) {
            if (! Auth::check()) {
                return;
            }

                $model->author_id = Auth::id();
        });
    }

    public function author()
    {
        return AuthorHelper::authorRelation($this);
    }
}
