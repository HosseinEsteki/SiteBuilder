# Persian Commerce Runtime Integration Recovery

## Root causes

- `ThemeSeeder` still installed the generic starter theme and did not create the recovered homepage/template selections.
- `BlockRegistry` knew only the base builder blocks.
- `ThemeRenderer` did not merge `ThemeBlockResolver` provider data into dynamic block views.
- Recovered blog identifiers used `blog_posts` while the resolver/view still assumed `posts`.
- The public category/article route names referenced by recovered views were absent.
- The root route still rendered Laravel's welcome view and the recovered layout did not output selected header/footer HTML.
- Fresh Blog seed data contained no published article.

## Seed records restored

- One idempotent active theme: `persian-commerce`.
- Published default templates: `header`, `footer`, `homepage`, `product`, `product_archive`, `product_category`, `blog_archive`, and `article`.
- One published `home` ThemePage containing recovered homepage builder data.
- Every template/page selection uses the Persian Commerce theme; IDs are resolved from created models.
- One existing sample Blog article is now published so a fresh seed has a resolvable article page.

## Registered blocks

Homepage/dynamic: `hero_slider`, `promotion_banner_grid`, `product_carousel`, `featured_products`, `discounted_products`, `category_product_section`, `category_grid`, `brand_carousel`, `blog_posts`.

Seeded layout support: `announcement_bar`, `site_logo`, `category_menu`, `footer_brand`, `copyright`.

Dynamic rendering now merges the existing product/category/brand/blog providers into Blade data. Product and article providers select published records and retain bounded limits and safe empty collections.

## Public routes

- `/` (`theme.homepage`) and `/shop` (`theme.shop`) render the active seeded homepage.
- `/products` (`products.index`) and `/products/{product}` (`products.show`) reuse Ecommerce's controller and slug binding.
- `/product-categories/{category}` (`product-categories.show`) reuses Ecommerce's category controller/binding.
- `/blog/articles` (`articles.index`) and `/blog/articles/{slug}` (`articles.show`) reuse Blog's controller; article detail is publication-filtered.
- Existing API route contracts were not changed.

## Files changed

- Theme seed, registry, renderer, block resolver, homepage controller/routes/layout/template, dynamic providers, and recovered posts block.
- Ecommerce public routes and product publication guard.
- Blog public routes, article publication guard/response, and sample seed status.
- Root route conflict removal.
- Theme builder expectation update and new runtime integration regression test.

## Regression coverage

`PersianCommerceRuntimeIntegrationTest` covers complete same-theme/idempotent seeding, recovered block registration, fresh homepage header/content/footer rendering, named category/article routes, and rejection of unpublished articles. Existing seeder and builder tests were retained and updated only where the recovered homepage superseded starter copy.

## Verification results

- `composer dump-autoload`: passed.
- `php artisan package:discover`: passed.
- `php artisan optimize:clear`: passed.
- `php artisan migrate:fresh --seed`: passed from an empty database.
- `php artisan route:list --except-vendor`: passed; 115 application routes listed.
- `php artisan test`: **87 tests, 248 assertions passed**.
- `npm run build`: passed (existing empty `app` chunk warning remains).
- `npm audit`: 0 vulnerabilities.
- `git diff --check`: passed.
- Feature requests verify `/`, seeded homepage regions, product-category detail, published article detail, and unpublished article 404 behavior. Product/archive and Blog archive routes are present and use their surviving controllers.

## Fresh-install rendering

The active resolver selects Persian Commerce. The root homepage returns 200 and renders selected header, recovered homepage content, selected footer, and empty/minimal dynamic datasets without missing-variable or missing-route exceptions.

## Remaining placeholders and visual limitations

- Product/category/article/archive endpoints retain their surviving controller response format; no new visual detail/archive templates were designed.
- Recovered hero remains a CSS scroll-snap presentation without autoplay.
- Cart, wishlist, newsletter submission, and other business interactions remain placeholders as required.
- No visual QA or polish was performed.
- Existing PHPUnit doc-comment metadata warnings remain outside this recovery scope.

## Recommended commit message

`Restore Persian Commerce runtime integration`
