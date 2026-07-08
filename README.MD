# SiteBuilder

SiteBuilder is a modular Laravel site builder. The project is intended to provide a customized WordPress-like foundation with ecommerce, blog, SEO, email, activity logging, public shared content, and an admin panel.

## Requirements

- PHP 8.4 or a compatible PHP version supported by Laravel 12
- Composer
- Node.js and npm
- SQLite for local development by default, or another database configured in `.env`

## Setup

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
npm install
npm run build
```

Useful verification commands:

```bash
composer dump-autoload
php artisan package:discover
php artisan about
php artisan route:list
php artisan test
```

## Modules

- `modules/admin-panel`: admin panel package shell and route loading.
- `modules/activity-log`: automatic Eloquent activity logging and activity log API routes.
- `modules/blog`: articles, categories, comments, tags, media, and blog API/web routes.
- `modules/ecommerce`: products, categories, brands, carts, orders, discounts, coupons, payment stubs, media, and ecommerce routes.
- `modules/email`: mail classes and test email route.
- `modules/public`: shared post model, author helpers, enums, Persian date helpers, and shared migrations.
- `modules/seo`: meta manager, schema helpers, redirects, sitemap command, and SEO facade.
- `modules/theme`: experimental theme module shell.

## Admin

The Filament admin panel is available at:

```text
/admin
```

## Notes

The modules are Composer path repositories. Local development expects those packages to be linked from `modules/*` so package code changes are reflected in the main application.
