<?php

namespace Theme\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ThemeTemplate extends Model
{
    protected $table = 'theme_templates';

    protected $fillable = [
        'theme_id',
        'name',
        'slug',
        'type',
        'builder_data',
        'custom_css',
        'status',
        'is_default',
    ];

    protected $casts = [
        'builder_data' => 'array',
        'is_default' => 'boolean',
    ];

    public function theme(): BelongsTo
    {
        return $this->belongsTo(Theme::class);
    }

    public function pages(): HasMany
    {
        return $this->hasMany(ThemePage::class, 'template_id');
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', 'published');
    }

    public function scopeDraft(Builder $query): Builder
    {
        return $query->where('status', 'draft');
    }
}
