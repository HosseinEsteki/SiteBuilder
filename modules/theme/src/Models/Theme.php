<?php

namespace Theme\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Theme extends Model
{
    protected $table = 'theme_themes';

    protected $fillable = [
        'name',
        'slug',
        'description',
        'is_active',
        'settings',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'settings' => 'array',
    ];

    public function templates(): HasMany
    {
        return $this->hasMany(ThemeTemplate::class);
    }

    public function pages(): HasMany
    {
        return $this->hasMany(ThemePage::class);
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }
}
