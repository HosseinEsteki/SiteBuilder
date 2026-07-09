<?php

namespace Theme\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ThemePage extends Model
{
    protected $table = 'theme_pages';

    protected $fillable = [
        'theme_id',
        'template_id',
        'title',
        'slug',
        'excerpt',
        'builder_data',
        'custom_css',
        'meta_title',
        'meta_description',
        'status',
        'published_at',
    ];

    protected $casts = [
        'builder_data' => 'array',
        'published_at' => 'datetime',
    ];

    public function theme(): BelongsTo
    {
        return $this->belongsTo(Theme::class);
    }

    public function template(): BelongsTo
    {
        return $this->belongsTo(ThemeTemplate::class, 'template_id');
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
