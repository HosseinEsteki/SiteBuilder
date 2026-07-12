# Persian Commerce Theme Runtime Integration Recovery

Date: 2026-07-12

## Result

The recovered Persian Commerce Theme now survives a fresh migration and seed and resolves its public homepage, product archive/detail/category pages, blog archive, and article detail pages through the active Theme presentation flow. Dynamic homepage data renders safely when datasets are empty.

## Root causes and repairs

- The seed structure did not consistently connect the published `home` page to the published `homepage` template. `ThemeSeeder` now uses idempotent same-theme lookups, rejects a template or home-page slug owned by another theme, maintains one selected default per seeded type, and assigns the homepage template to the home page without fixed IDs.
- Recovered dynamic block views and providers were present while the surviving registry only exposed legacy content blocks. The registry now exposes the implemented Persian Commerce homepage, header, footer, product, archive, and search block contracts used by seeded builder data; `ThemeBlockResolver` supplies dynamic data and safe empty collections.
- The Ecommerce and Blog web route files now expose `product-categories.show` and `articles.show`. Product categories reuse the Ecommerce archive service and Theme controller. Blog web routes use dedicated Theme-rendered controller methods, while the existing JSON actions remain available to API routes.
- Seed-dependent archive/search tests assumed random seed data relationships and one search assertion confused the reflected query with a leaked draft result. The tests now create explicit valid products and assert the rendered result-card contract.

## Seeded Persian Commerce structure

Fresh seeding creates exactly one active `persian-commerce` theme and published defaults for:

- `header`
- `footer`
- `homepage`
- `product_archive`
- `product`
- `product_category`
- `search_results`
- `blog_archive`
- `article`

It also creates the published `home` ThemePage, whose selected template is the same theme's published `homepage` template. No unsupported product-brand or blog-category template type was invented.

## Registered recovered blocks

The recovered runtime registry includes the seeded dynamic homepage blocks `hero_slider`, `promotion_banner_grid`, `featured_products`, `discounted_products`, `category_grid`, `brand_carousel`, and `blog_posts`, plus implemented dynamic variants `product_carousel` and `category_product_section`. It also includes the recovered header/footer blocks and the implemented product-detail, archive, and search blocks used by the seeded templates.

Every seeded block type has a registered Blade view. Dynamic queries remain in data providers/services rather than Blade, and optional empty data renders through empty-state views.

## Routes restored

- `product-categories.show`: `GET /product-categories/{category}` with slug binding, owned by Ecommerce.
- `articles.show`: `GET /blog/articles/{slug}`, owned by Blog and restricted to published articles in its Theme-rendered web action.

The Blog JSON `index` and `show` actions remain used by the existing API routes.

## Public pages verified

- `/` homepage with active header, seeded builder data, dynamic blocks, and footer
- authenticated ThemePage preview route remains available
- `/shop` product archive
- `/products/{product}` product detail
- `/product-categories/{category}` product category
- `/blog/articles` blog archive
- `/blog/articles/{slug}` published article detail

Focused tests verify that unpublished product categories/articles are not exposed and empty datasets render safely.

## Tests added or strengthened

- Same-theme, published-default, homepage-template, and idempotency assertions
- Seeded homepage block registration assertions
- Fresh-seeded homepage header/content/footer rendering
- Product-category and article named-route resolution through Theme presentation
- Blog archive and article template/chrome assertions
- Deterministic archive/search product fixtures and draft exclusion assertions

Final suite: **101 passed, 326 assertions**. Four existing PHPUnit doc-comment metadata deprecation warnings remain in `EcommerceFlowTest`.

## Verification

- `composer dump-autoload`: passed
- `php artisan package:discover`: passed
- `php artisan optimize:clear`: passed
- `php artisan migrate:fresh --seed`: passed
- `php artisan route:list`: passed; both required names confirmed
- `php artisan test`: passed, 101 tests and 326 assertions
- `npm audit`: passed, 0 vulnerabilities
- `npm run build`: passed with Vite 7.3.6
- `git diff --check`: passed

## Remaining runtime limitations

- Product-brand and blog-category Theme template types were not added because the recovered `TemplateResolver` flow does not establish dedicated public presentation paths for them.
- Article and blog-archive templates currently preserve the recovered empty builder structures; they render Theme chrome and accept context but no unsupported article-specific blocks were invented.
- Cart, wishlist, newsletter submission, autoplay, and other new interactions remain intentionally unimplemented.
- Visual QA and design polish were intentionally not started.

## Partially reconstructed files touched

No file classified as `RECONSTRUCTED_WITH_PARTIAL_CONFIDENCE` in `THEME_RECOVERY_FINAL_AUDIT.csv` was modified by this runtime repair. The work changed the Theme seeder, Blog controller/routes, and focused runtime regression tests.

## Recommended commit message

`Restore Persian Commerce runtime integration`
