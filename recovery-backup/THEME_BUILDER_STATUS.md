# Theme Builder Status

## Completed Features

- Theme module is registered as `hosseinesteki/theme` and auto-discovered by Laravel.
- Data foundation exists for themes, templates, and pages.
- Builder content is stored as JSON in `builder_data`.
- Server-side rendering is handled by `Theme\Builder\ThemeRenderer`.
- MVP blocks are registered: section, container, columns, heading, text, image, button, spacer, hero, card, and html.
- Public published pages render at `/pages/{slug}`.
- Draft preview is available at `/admin/theme/pages/{page}/preview` for authorized authenticated users.
- Filament resources exist for themes, templates, and pages under `Theme Builder`.
- Spatie Permission permissions protect theme admin resources and preview access.
- Seed data creates a default active theme, header, footer, home page, about page, and sample landing page.
- Automated tests cover rendering, public routes, preview authorization, permissions, and seeded home rendering.

## Current Limitations

- Builder editing is form-based in Filament; drag-and-drop editing is not implemented.
- Header and footer templates are not yet globally injected into every public rendered page.
- Theme settings are stored but not yet used as full design tokens.
- The public route is `/pages/{slug}` only; root homepage and catch-all routing are not implemented.
- The `html` block renders raw HTML and is safe only for trusted admin use.
- SEO integration is limited to meta title and meta description fields.

## Known Issues

- `npm run build` passes but Vite reports an empty `app` JavaScript chunk.
- `php artisan test` passes but PHPUnit warns that doc-comment metadata in `Tests\Feature\EcommerceFlowTest` is deprecated for PHPUnit 12.
- Theme Builder Filament tests are relatively slow because they render full admin pages.

## How To Test Manually

1. Run setup and seed data:

```bash
php artisan migrate:fresh --seed
```

2. Start the app:

```bash
php artisan serve
```

3. Open the seeded public page:

```text
http://localhost:8000/pages/home
```

4. Log in to Filament:

```text
http://localhost:8000/admin
```

5. Open the Theme Builder resources from the admin navigation group:

```text
Theme Builder -> Themes
Theme Builder -> Templates
Theme Builder -> Pages
```

6. Edit a theme page, preview it, publish/unpublish it, then confirm draft pages are not visible publicly.

## Suggested Next Phase

- Add global header/footer composition around theme pages.
- Add a real visual page-builder editing experience on top of the current JSON schema.
- Add media picker support for image blocks.
- Add homepage/catch-all routing with conflict protection for existing module routes.
- Expand SEO integration with sitemap and structured schema output.
- Add page revisions, autosave, and publish workflow history.
