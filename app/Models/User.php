<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Ecommerce\Models\Product;
use Blog\Models\Article;
use Ecommerce\Models\Order;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Public\Traits\HasPersianDate;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements HasMedia, FilamentUser
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;
    use HasRoles;
    use HasPersianDate;
    use InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the user's initials
     */
    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->take(2)
            ->map(fn ($word) => Str::substr($word, 0, 1))
            ->implode('');
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return $this->hasAnyRole(['Super Admin', 'Editor', 'مدیرکل'])
            || $this->getAllPermissions()->isNotEmpty();
    }

    /*
   |--------------------------------------------------------------------------
   | Media Library
   |--------------------------------------------------------------------------
   */


    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('user')
            ->singleFile()
            ->useDisk('user');
}

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

    public function articles(): HasMany
    {
        return $this->hasMany(Article::class, 'author_id');
    }

    protected function articleCount(): Attribute
    {
        return Attribute::make(
            get: fn($value, array $attributes) => $this->articles()->count(),
        );
    }
    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'author_id');
    }

    protected function productCount(): Attribute
    {
        return Attribute::make(
            get: fn($value, array $attributes) => $this->products()->count(),
        );
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'user_id');
    }
}
