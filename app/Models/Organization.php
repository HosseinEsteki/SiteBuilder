<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Organization extends Model
{
    use InteractsWithMedia;
    protected $fillable = [
        'name',
        'website',
        'phone',
        'social_links',
    ];

    protected $casts = [
        'social_links' => 'array',
    ];

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(200)
            ->height(200)
            ->sharpen(10);

        $this->addMediaConversion('preview')
            ->width(800)
            ->height(600);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('organization')->useDisk('public');
    }

    /**
     * گرفتن URL لوگو
     */
    public function getLogoUrlAttribute()
    {
        return $this->getFirstMediaUrl('organization.logo', 'thumb');
    }
    public function getBrandUrlAttribute()
    {
        return $this->getFirstMediaUrl('organization.brand', 'thumb');
    }
}
