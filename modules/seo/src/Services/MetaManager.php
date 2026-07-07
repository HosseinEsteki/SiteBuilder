<?php

namespace Seo\Services;

use Artesaos\SEOTools\Facades\SEOTools;

class MetaManager
{
    /**
     * تنظیم عنوان صفحه
     */
    public function setTitle(string $title): void
    {
        SEOTools::setTitle($title);
    }

    /**
     * تنظیم توضیحات صفحه
     */
    public function setDescription(string $description): void
    {
        SEOTools::setDescription($description);
    }

    /**
     * تنظیم کلمات کلیدی
     */
    public function setKeywords(array $keywords): void
    {
        SEOTools::metatags()->setKeywords($keywords);
    }

    /**
     * تنظیم Canonical URL
     */
    public function setCanonical(string $url): void
    {
        SEOTools::setCanonical($url);
    }

    /**
     * تنظیم OpenGraph
     */
    public function setOpenGraph(string $title, string $url, string $image): void
    {
        SEOTools::opengraph()->setTitle($title);
        SEOTools::opengraph()->setUrl($url);
        SEOTools::opengraph()->addImage($image);
    }

    /**
     * تنظیم Twitter Card
     */
    public function setTwitterCard(string $title, string $site, string $image): void
    {
        SEOTools::twitter()->setTitle($title);
        SEOTools::twitter()->setSite($site);
        SEOTools::twitter()->addImage($image);
    }

    /**
     * گرفتن خروجی HTML متاتگ‌ها
     */
    public function render(): string
    {
        return SEOTools::generate();
    }
}
