<?php

namespace App\Filament\Components\Filters;

use App\Models\User;
use Blog\Enums\BlogPermission;
use Ecommerce\Enums\EcommercePermission;
use Filament\Tables\Filters\SelectFilter;

class AuthorFilter
{
    /**
     * @param BlogPermission|EcommercePermission $permission
     * @return SelectFilter
     */
    public static function make(BlogPermission|EcommercePermission $permission)
    {
        return SelectFilter::make('author_id')
            ->label(trans('permissions.author'))
            ->options(
                User::permission($permission->value)->pluck('name','id')->toArray(),
            )
            ->searchable()
            ->preload();
    }
}
