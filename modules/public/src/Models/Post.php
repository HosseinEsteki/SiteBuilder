<?php

namespace Public\Models;

use App\Helpers\PostHelper;
use Athphane\FilamentEditorjs\FilamentEditorjs;
use Athphane\FilamentEditorjs\Traits\ModelHasEditorJsComponent;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Public\Enums\PostStatus;
use Public\Traits\HasAuthor;
use Public\Traits\HasPersianDate;
use Seo\Traits\HasSEO;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Tags\HasTags;

class Post extends Model implements HasMedia
{
    use HasAuthor, HasPersianDate, HasSEO, HasSlug, HasTags;
    use InteractsWithMedia, ModelHasEditorJsComponent;

 protected $fillable = PostHelper::fillable;
 protected $appends = PostHelper::appends;


    //region Status Attribute (Enum Mapping)
    /**
     * Map stored status string to PostStatus enum value.
     */
    protected function status(): Attribute
    {
        return Attribute::make(
            get: function ($value, array $attributes) {
                foreach (PostStatus::cases() as $case) {
                    if (strcasecmp($case->name, $value) === 0) {
                        return $case->value;
                    }
                }
                return $value;
            },
            set: fn($value) => $value,
        );
    }
    //endregion


    //region Content Attribute (JSON decode/encode)
    /**
     * Decode JSON content when reading.
     */
    protected function content(): Attribute
    {
        return Attribute::make(
            get: fn($value) =>
            is_string($value) ? json_decode($value, true) : $value,

            set: fn($value) =>json_encode($value), // اگر نیاز به encode باشد اینجا json_encode قرار می‌گیرد
        );
    }
    //endregion


    //region Show Content (Rendered HTML)
    /**
     * Virtual attribute: returns rendered EditorJS HTML.
     */
    protected function showContent(): Attribute
    {
        return Attribute::make(
            get: fn($value, array $attributes) =>
            FilamentEditorjs::renderContent($attributes['content']),
        );
    }
    //endregion



    //region Slug Options
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }
    //endregion


    //region Media Conversions
    /**
     * Register media conversions (thumb & preview).
     */
    public function registerMediaConversions(?Media $media = null): void
    {
        // Thumbnail
        $this->addMediaConversion('thumb')
            ->width(200)
            ->height(200)
            ->sharpen(10);

        // Preview
        $this->addMediaConversion('preview')
            ->width(800)
            ->height(600);
    }
    //endregion

}
