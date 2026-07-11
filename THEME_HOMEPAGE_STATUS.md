# Persian Commerce Homepage Status

## Completed

- Recovered homepage template rendering and blocks for hero slides, promotion banners, products, categories, brands, and blog posts.
- Responsive hero `<picture>` sources, configurable height/overlay, CTA markup, and first-image priority.
- Dynamic provider classes for products, categories, brands, and blog articles with bounded query limits.
- Lazy banner, product, brand, category, trust, and blog imagery where supported.
- Empty states for unavailable dynamic content.

## Placeholders and limitations

- Hero is a scroll-snap list; no autoplay, pagination, or JavaScript carousel controls are claimed.
- Product/cart interactions remain presentation hooks only.
- Blog links depend on routes available in the host application; no Blog behavior was changed.
- The current seeder remains the older generic Theme seed, so `/shop` may return 404 until a published `homepage` template is configured.
- The tracked registry/renderer and Filament builder do not yet register all recovered dynamic blocks.

## Manual verification

1. Create/publish a `homepage` ThemeTemplate containing recovered homepage blocks.
2. Open `/shop`; verify hero media, banners, product/category grids, brands, posts, and empty states.
3. Check desktop and mobile layouts without assuming autoplay or cart persistence.
4. Run `php artisan test tests/Feature/PersianCommerceHomepageTest.php tests/Feature/ThemeDynamicDataTest.php`.
