# Persian Commerce Product Archive Status

## Routes and templates

- Shop: `GET /shop`, route `theme.shop`, template type `product_archive`.
- Category: `GET /product-categories/{category:slug}`, route `product-categories.show`, template type `product_category`.
- Both default published templates belong to the active Persian Commerce theme, are resolved by `TemplateResolver`, rendered by `ThemeRenderer`, and seeded idempotently without database IDs.

## Blocks

Created: archive breadcrumbs, archive header, category navigation, product filters, sorting toolbar, active-filter chips, product grid, pagination, and empty state. Reused: shared Product Card and service features.

## Ecommerce integration

`ProductArchiveService` owns publication restrictions, eager loading, filtering, sorting, and 12-item Laravel pagination. Theme views receive materialized models/paginator only and make no product/category queries.

Supported filters: category slug, brand slug, minimum/maximum sale price, in-stock, and discounted. Supported sorts: newest, price ascending, price descending, discount amount, and title. GET parameters and paginator/sort links preserve the active query string.

Categories and brands gained the genuinely missing `is_published` field and published scopes. Category nesting is not shown because the existing schema has no parent relationship.

## Builder and presentation

All archive areas are structured registered blocks with settings stored in `builder_data`; no raw JSON is required for runtime rendering. Settings cover headings, description/result visibility, navigation limit/columns, filter and sorting visibility, card variant/fields, responsive grid columns, pagination, empty state, and service-feature visibility.

The presentation is Persian RTL and responsive: configurable four/three/two-column defaults, mobile filter disclosure, adaptive toolbar, stable shared cards, no horizontal overflow, safe focus styles, semantic H1, labeled GET controls, lazy supporting images, accessible breadcrumbs and pagination.

## Verification

- `composer dump-autoload`: passed.
- `php artisan package:discover`: passed.
- `php artisan optimize:clear`: passed.
- `php artisan migrate:fresh --seed`: passed.
- Route inspection: passed.
- Existing full suite plus 5 focused archive tests: passed.
- `npm run build`: passed.
- `npm audit`: 0 vulnerabilities.
- `git diff --check`: passed.

Focused coverage includes template/default resolution, `/shop`, published/unpublished categories, shared cards, theme chrome, publication filtering, query preservation, and empty categories.

## Limitations and placeholders

- Parent/child category breadcrumbs/navigation are omitted because there is no nesting schema.
- No review/rating ranking or other unsupported filters were introduced.
- Search, brand archives, cart, checkout, wishlist, reviews, and payments remain outside this work.

Recommended commit message: `feat(theme): add Persian commerce product archives`
