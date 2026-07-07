<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Organization extends Model
{
    use InteractsWithMedia;
    protected $fillable = [
        'key',
        'value',
        'category',
    ];
    protected $appends=['category_label','name_label'];
    public static function all($columns = ['*'])
    {
        $settings = \App\Models\Organization::
        query()
            ->groupBy('category', 'key')
            ->get()
            ->groupBy('category')
            ->collect()
        ;
        return collect($settings);
    }

    public static function getCategoryLabel(string $category)
    {
        return trans('organization.'.$category.'.label');
    }


    protected function categoryLabel(): Attribute
    {
        return Attribute::make(
            get: fn($value, array $attributes) => trans("organization.{$this->category}.label"),
        );
    }

    protected function nameLabel(): Attribute
    {
        return Attribute::make(
            get: fn($value, array $attributes) => trans("organization.{$this->category}.{$this->key}")
        );
    }


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
