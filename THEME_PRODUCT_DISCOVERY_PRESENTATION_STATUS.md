# Persian Commerce Product Discovery Presentation Status

## Delivered blocks

- `product_archive_header`: reusable context-driven heading, optional description/image, result count, safe breadcrumbs, search query, alignment, and compact/default variants.
- `product_listing_grid`: reusable paginator/collection presentation using the shared Product Card, responsive columns, configurable card fields/action, empty state, result count, and paginator links.

## Services and templates

- Reused `Ecommerce\Services\ProductArchiveService` for publication rules, eager loading, validated filters, sorting, searching, and pagination.
- Added only presentation-ready archive title, description, and eagerly-loaded category image data to its context.
- Updated the published default `product_archive`, `product_category`, and `search_results` templates idempotently to use both reusable blocks.
- Existing ThemeContext, TemplateResolver, ThemeRenderer, header/footer composition, route names, and same-theme ownership enforcement remain unchanged.

## Category, brand, and search

- Category pages render category title, optional description/image, and only matching published products. Draft categories remain unavailable.
- A public HTML brand archive is intentionally omitted: the existing brand route/controller is a JSON API contract and there is no supported `product_brand` template flow. No route or template type was invented.
- Search retains the existing trimmed, validated 255-character query, escaped wildcard handling, published-only matching, result count, filters, sorting, pagination, and safe empty-query/no-result behavior.

## Supported sorting and filters

- Sorting: newest, price ascending, price descending, highest absolute discount, and product title.
- Filters: category, brand, minimum/maximum sale price, in-stock availability, and discounted status.
- Controls preserve relevant scalar query parameters and use the Ecommerce service whitelist; no new algorithms or filtering schema were added.

## Responsive and accessibility

- RTL desktop/tablet/mobile grids use configurable 1–6 desktop, 1–4 tablet, and 1–2 mobile columns.
- Archive headers stack safely on narrow screens; titles, search terms, filters, and sorting controls wrap without horizontal overflow.
- Each page has one context-driven `h1`, meaningful category image alt text, textual/live result counts, labelled navigation, current-page pagination from Laravel, visible focus treatment, and 44px mobile pagination targets.

## Compatibility and limitations

- Ecommerce API response code and JSON contracts were not changed.
- The existing Product Card is reused without duplicated card markup.
- Cart, checkout, wishlist, reviews, new business logic, brand HTML archive, advanced filtering, and global visual QA remain out of scope.

## Verification

- Focused discovery tests cover registration/view availability, seeded templates, HTTP 200 archive/category/search responses, publication rules, category isolation, safe empty states, pagination, matching/no-result search, and supported query preservation.
- `composer dump-autoload`, package discovery, cache clearing, and fresh migration/seeding: passed.
- Routes: 146.
- Tests: 110 passed, 366 assertions.
- `npm audit`: 0 vulnerabilities.
- Vite production build: passed.
- `git diff --check`: passed.

## Recommended commit message

`feat(theme): add reusable Persian Commerce product discovery presentation`
