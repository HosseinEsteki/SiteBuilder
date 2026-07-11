# Persian Commerce Theme Recovery Inventory

## Confirmed missing source

- `modules/theme/resources/css/theme.css`
- `modules/theme/resources/css/header.css`
- `modules/theme/resources/css/footer.css`
- `modules/theme/resources/css/homepage.css`
- `modules/theme/resources/views/components/button.blade.php`
- `card.blade.php`, `badge.blade.php`, `section.blade.php`, `container.blade.php`
- `heading.blade.php`, `image.blade.php`, `price.blade.php`
- `product-card.blade.php`, `category-card.blade.php`
- `empty-state.blade.php`, `loading-skeleton.blade.php`

## Compiled evidence

- `recovery-backup/public-build/manifest.json` identifies `modules/theme/resources/css/theme.css` as the sole Theme Vite entry and `assets/theme-Dv024rt-.css` as its compiled output.
- The compiled CSS contains the design tokens, RTL/container system, header, footer, homepage, product/category card, and responsive selectors. Its import grouping supports the recovered split into `theme.css`, `header.css`, `footer.css`, and `homepage.css`.
- Compiled Blade cache files map exactly to all twelve missing components: `84574...` button, `4e6c...` card, `32fc...` badge, `430f...` section, `8c0a...` container, `1a783...` heading, `eef6...` image, `e2b01...` price, `49646...` product card, `8504...` category card, `64f551...` empty state, and `6fe12...` loading skeleton.
- The compiled views preserve props, PHP calculations, HTML output, attributes, class names, and Persian UI strings. These components can therefore be reconstructed with high confidence.

## Source references

- Theme block views reference the primitives through `x-theme::button`, `card`, `container`, `heading`, `image`, `section`, `empty-state`, `product-card`, and `category-card`.
- Product carousel and ecommerce block views require the product-card API and variants.
- Category grid requires category-card and product count output.
- Hero, promotion, brand, blog, header, and footer blocks use the recovered CSS selectors.
- `modules/theme/resources/views/layouts/main.blade.php` references the missing `theme.css` Vite entry and emits active-theme CSS variables.

## Selectors recovered

- Design system: `theme-container`, `theme-section`, `theme-grid`, `theme-card`, `theme-button`, `theme-badge`, `theme-heading`, `theme-image`, `theme-price`, `theme-empty`, `theme-skeleton`.
- Product/category: `theme-product-card*`, `theme-product-grid`, `theme-category-card*`, `theme-category-grid`.
- Header: `theme-announcement`, `theme-site-logo`, `theme-search`, `theme-header-action`, `theme-category-nav`, `theme-mega*`, `theme-mobile-*`.
- Footer: `theme-services*`, `theme-footer-*`, `theme-newsletter`, `theme-trust`, `theme-copyright`, `theme-bottom-nav`.
- Homepage: `theme-hero-*`, `theme-promotion*`, `theme-brand-*`, `theme-blog-*`, `theme-section-title`.
- Responsive breakpoints recovered at 639/640px, 767px, 1023/1024px.

## Confidence

All twelve Blade components are recoverable exactly in behavior from compiled views. CSS is recoverable with high confidence from the minified production bundle and its observed source grouping; whitespace/source formatting and original rule ordering between imported files are approximations. No separate `design-system.css` or `product-card.css` entry is evidenced; those rules belonged to `theme.css`.
