<?php

namespace Seo\Traits;

use App\Helpers\SeoHelper;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Seo\Services\MetaManager;

trait HasSEO
{
    public function initializeHasSEO()
    {
        $this->mergeFillable(SeoHelper::$fillable);
    }
    /**
     * تولید متاتگ‌ها و OpenGraph برای مدل
     */
    public function generateSEO(MetaManager $seo): void
    {
        $seo->setTitle($this->getSeoTitle());
        $seo->setDescription($this->getSeoDescription());
        $seo->setKeywords($this->getSeoKeywords());
        $seo->setCanonical($this->getSeoUrl());
        $seo->setOpenGraph(
            $this->getSeoTitle(),
            $this->getSeoUrl(),
            $this->getSeoImage()
        );
    }

    /**
     * عنوان سئو
     */
    public function getSeoTitle(): string
    {
        return $this->title ?? $this->name;
    }

    /**
     * توضیحات سئو
     */
    public function getSeoDescription(): string
    {
        return $this->description ?? 'Default description';
    }

    /**
     * کلمات کلیدی سئو
     */
    public function getSeoKeywords(): array
    {
        return $this->keywords ?? [];
    }

    /**
     * URL کاننیکال
     */
    public function getSeoUrl(): string
    {
        return route(strtolower(class_basename($this)).'.show', $this->id);
    }

    /**
     * تصویر برای OpenGraph
     */
    public function getSeoImage(): string
    {
        return $this->logo_url ?? asset('default-image.jpg');
    }

    protected function keywords(): Attribute
    {
        return Attribute::make(
            get: fn ($value, array $attributes) => json_decode($value, true),
            set: fn ($value) => json_encode($value),
        );
    }

    protected function casts(): array
    {
        $parentCasts = method_exists(get_parent_class($this), 'casts')
            ? parent::casts()
            : [];

        return array_merge($parentCasts, [
            'keywords' => 'array',
        ]);
    }
}
