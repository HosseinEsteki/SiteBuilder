# Persian Commerce Storefront Visual QA

## Scope reviewed

Code-based review covered the homepage, shop archive, populated and empty category states, search with and without matches, normal/discounted/minimal-metadata product details, blog archive, and published article details. The header, footer, shared Product Card variants, forms, pagination, media handling, RTL behavior, and public layout were reviewed with them.

The target viewport matrix is 1440×900, 1280×800, 1024×768, 768×1024, 430×932, 390×844, and 360×800. Automated visual viewport capture was unavailable in the current environment, so these sizes remain in the manual checklist below rather than being represented as screenshot-verified.

## Issues found and improvements

- Removed the remote Google Fonts import and retained the existing configurable font stack with local system fallbacks.
- Made RTL explicit on the document element and added a keyboard-visible skip link to the main content landmark.
- Extended the shared focus treatment to selects and text areas, improved muted-text contrast, preserved tabular price numerals, and made reduced-motion behavior cover hover transforms and transitions.
- Corrected the RTL search-field padding with logical properties and made long desktop category navigation safely scrollable.
- Improved very-narrow mobile-header spacing without changing its behavior or actions.
- Kept Product Cards equal-height with consistent clamped titles, intentional placeholders, stable image ratios, stock text, disabled states, and shared markup across all consumers.
- Added long-title wrapping for archive headers and retained responsive filter, toolbar, grid, empty-state, and 44px pagination behavior.
- Improved product-gallery thumbnail hit areas, long summary wrapping, and minimum-width handling for detail sections.
- Made article cards flex to consistent height; added safe responsive tables and embeds, clearer table cells, and more readable list rhythm.
- Added footer link hover distinction, keyboard focus containment in the fixed mobile navigation, and stable trust-badge focus boxes.
- Confirmed the Theme stylesheet remains one Vite entry, public layouts do not load Filament assets, Blade templates do not introduce database queries, and no package or remote asset was added.

## Files changed

- `modules/theme/resources/views/layouts/main.blade.php`
- `modules/theme/resources/views/templates/show.blade.php`
- `modules/theme/resources/css/theme.css`
- `modules/theme/resources/css/product-discovery.css`
- `modules/theme/resources/css/storefront-qa.css`
- `tests/Feature/PersianCommerceRuntimeIntegrationTest.php`
- `THEME_STOREFRONT_VISUAL_QA.md`

## Tests changed

The runtime integration test now verifies explicit RTL direction, the skip link, and the addressable main landmark. Existing presentation tests continue to cover shared Product Card variants and placeholders, accessible image behavior, archive empty states and pagination, safe optional product metadata, semantic article markup, and mobile-navigation labels.

## Manual viewport and interaction checklist

At each target size (1440×900, 1280×800, 1024×768, 768×1024, 430×932, 390×844, 360×800):

- Homepage: inspect hero crop and manual horizontal scrolling, sections, banners, product rows/cards, brands, articles, services, and newsletter presentation.
- Shop/category/search: test populated and empty states, long Persian titles and queries, filters, sort controls, grid flow, result count, and multi-page pagination.
- Product detail: compare normal, discounted, and missing-optional-metadata products; inspect gallery containment, thumbnails, mixed-direction SKU, price, quantity, specifications, and related cards.
- Blog/article: inspect card heights and crops, long titles/excerpts, reading width, headings, lists, quotes, wide tables, inline images, embeds, and related articles.
- Header/footer: inspect sticky-header overlap, long navigation labels, mobile actions, footer columns, trust badges, safe-area padding, and fixed bottom navigation.
- Keyboard: activate the skip link, traverse header/search/menu/actions/forms/cards/pagination/footer in order, and confirm every focus indicator is visible.
- Confirm no horizontal page scrollbar, clipped content, broken images, fixed-element overlap, or delayed first hero image.

## Known limitations

- Browser screenshot automation was unavailable, so pixel-level appearance and real-device safe-area behavior require the manual pass above.
- Cart, checkout, wishlist, reviews, newsletter submission, slider autoplay, and brand HTML archives remain intentionally unimplemented.
- No business queries, API contracts, routes, schemas, Theme architecture, block types, component APIs, or seeded builder data were changed.

## Final verification

- Composer autoload generation, package discovery, cache clearing, fresh migration, and seeding passed.
- Route count: 146.
- Test result: 110 passed with 369 assertions.
- npm audit: 0 vulnerabilities.
- Vite production build: passed (theme CSS 32.83 kB, 6.71 kB gzip).
- `git diff --check`: passed.
- All required Theme source paths and `vite.config.js` remain present.
- Git status contains only the intended source, test, and report changes; no generated build artifact is tracked as a change.

Recommended commit message: `style(theme): polish storefront-wide RTL visual presentation`
