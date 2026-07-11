# Persian Commerce Product Detail Status

## Product route used

- Canonical route: `products.show`
- URI: `/products/{product}`
- Binding: existing custom route binding accepts product slug or ID.
- Public visibility: the existing raw `status` check limits detail rendering to `PostStatus::Published` products; drafts return 404.

## Template type and assignment

- Template type: `product` (the existing project convention).
- Seeded slug: `persian-commerce-product`.
- The published default template belongs to the active `persian-commerce` theme.
- Seeding uses `updateOrCreate`, remains idempotent, and contains editable `builder_data` without database IDs.
- The existing `TemplateResolver` selects the active theme's published default product template, so changing the active theme can change presentation.

## Blocks created or reused

- Created: product breadcrumbs, gallery, summary, price, purchase panel, description, specifications, meta, and related products.
- Reused: shared price, badge, button, product-card, empty-state design conventions, header/footer templates, and service-features block.
- Header and footer continue to compose through `ThemeRenderer` around product content.

## Dynamic data sources

- The route-bound Ecommerce `Product` remains the source for product data.
- The controller eager-loads brand, category, feature options and their feature, media, and tags.
- Existing Product accessors provide thumbnail and gallery URLs.
- EditorJS content uses the existing `show_content` rendering convention.
- `ProductDataProvider::related()` queries published products, excludes the current product, prioritizes its category, eager-loads brand, and caps the configurable limit at 12.

## Filament settings added

Structured Builder controls now cover:

- Category visibility in breadcrumbs.
- Gallery layout and thumbnail visibility.
- Brand, category, and stock visibility in summary.
- Price visibility.
- Purchase-panel label and stock visibility.
- Description, specification, meta, and related-section titles.
- Empty-specification behavior.
- Related-product limit and card variant.
- Service-feature visibility.

No raw JSON field was introduced.

## Responsive behavior

- Desktop: two-column gallery/detail layout with stable square media and balanced content width.
- Tablet: single adaptive column below 900px with bounded gallery height.
- Mobile: stacked content, 64px touch thumbnails, full-width purchase action, two-column related cards, responsive gutters, and bottom-navigation-safe page spacing.
- The implementation is RTL-native and prevents page-level horizontal overflow.

## Accessibility changes

- Semantic breadcrumb navigation and current-page state.
- One product `h1`, followed by section `h2` headings.
- Product-name alt text for the primary image and a labelled missing-image fallback.
- Accessible quantity label, numeric input constraints, disabled unavailable state, and clearly labelled purchase action.
- Existing global visible focus treatment applies to links, controls, thumbnails, and cards.
- Primary media is high priority; additional gallery thumbnails are lazy-loaded.

## Tests added

`PersianCommerceProductDetailTest` covers:

- Published default product template assignment and idempotent seeding.
- Published product route rendering through the active theme.
- Header/footer composition and gallery fallback.
- Regular/sale price output.
- Draft product 404 behavior.
- Missing optional brand and empty feature/media/related data safety.
- Related-product exclusion and shared product-card markup.

Final suite: **92 tests passed, 270 assertions**.

## Build and verification status

- `composer dump-autoload` — passed.
- `php artisan package:discover` — passed.
- `php artisan optimize:clear` — passed.
- `php artisan migrate:fresh --seed` — passed.
- `php artisan route:list` — passed; canonical product routes are registered.
- `php artisan test` — 92 passed, 270 assertions.
- `npm run build` — passed; theme CSS bundle generated successfully.
- `npm audit` — 0 vulnerabilities.
- `git diff --check` — passed.
- Focused feature requests covered published, unpublished, sale-price, missing-image, missing-brand, empty-feature, and empty-related cases.
- The public layout loads only the Vite theme stylesheet; no Filament public asset inclusion was added.

## Remaining placeholders

- Quantity and add-to-cart controls are presentation-only. The existing `data-cart-action` and `data-product-id` hooks are present, with no persistence or cart business logic.
- Gallery thumbnails link directly to image assets; no JavaScript gallery dependency was added.

## Remaining limitations

- Category is required by the current database schema, so a persisted product cannot genuinely lack a category; the views still guard category access defensively.
- No browser-backed screenshot or visual viewport run was available in this session.
- SKU and seller/vendor output were omitted because those fields do not exist on the current Product model/schema.

## Recommended commit message

`Build themed Persian Commerce product detail template`
