# Persian Commerce Product Card Status

## Completed

- Default, compact, and horizontal variants.
- Lazy product image with placeholder fallback.
- Product name, optional brand/rating/information, current and old prices, discount percentage, and stock state.
- Disabled cart action for unavailable products.
- Responsive two-column product grid and card styling from active Theme variables.
- Recovered tests cover price hierarchy, discounts, stock, cart button state, and missing images.

## Placeholders and limitations

- The cart button provides markup/data attributes only; recovered source does not prove an add-to-cart request handler.
- Wishlist is deliberately disabled and labeled “coming soon.”
- No product-detail route or product-detail page is part of this recovery.
- Rating data is displayed only when supplied; no rating calculation was added.

## Manual verification

1. Render cards with regular, discounted, unavailable, and image-less products.
2. Confirm old/current prices, percentage badge, stock text, and disabled state.
3. Compare default, compact, and horizontal variants at desktop and mobile widths.
4. Run `php artisan test tests/Feature/ThemeProductCardTest.php`.
