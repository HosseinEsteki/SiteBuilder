# Theme Module

The Theme module provides the MVP foundation for an Elementor-like page builder inside SiteBuilder. It is a Laravel path package registered as `hosseinesteki/theme` and auto-discovered through `Theme\Providers\ThemeServiceProvider`.

## What It Does

- Stores themes, templates, and pages in dedicated theme tables.
- Stores page content as structured JSON in `builder_data`.
- Renders published pages through a server-side Blade block renderer.
- Provides Filament resources for managing themes, templates, and pages.
- Secures admin theme builder screens with Spatie Permission permissions.

## Data Models

- `Theme\Models\Theme`
  - Table: `theme_themes`
  - Fields: `name`, `slug`, `description`, `is_active`, `settings`
  - Relations: has many templates and pages

- `Theme\Models\ThemeTemplate`
  - Table: `theme_templates`
  - Fields: `theme_id`, `name`, `slug`, `type`, `builder_data`, `custom_css`, `status`, `is_default`
  - Relations: belongs to theme, has many pages

- `Theme\Models\ThemePage`
  - Table: `theme_pages`
  - Fields: `theme_id`, `template_id`, `title`, `slug`, `excerpt`, `builder_data`, `custom_css`, `meta_title`, `meta_description`, `status`, `published_at`
  - Relations: belongs to theme and template

## Builder JSON Schema

Builder content is stored as an array of block objects. Each block has a `type`, optional `settings`, and optional `children`.

```json
[
  {
    "type": "section",
    "settings": {
      "background_color": "#ffffff",
      "padding_top": 64,
      "padding_bottom": 64,
      "container_width": "lg"
    },
    "children": [
      {
        "type": "heading",
        "settings": {
          "text": "Welcome to SiteBuilder",
          "level": "h1",
          "align": "center"
        }
      }
    ]
  }
]
```

Unknown block types are ignored safely by the renderer. Text-oriented blocks escape output by default. The `html` block renders raw HTML and must only be used with trusted admin-authored content.

## Available Blocks

- `section`
- `container`
- `columns`
- `heading`
- `text`
- `image`
- `button`
- `spacer`
- `hero`
- `card`
- `html`

Block definitions live in `Theme\Builder\BlockRegistry`. Rendering is handled by `Theme\Builder\ThemeRenderer` using Blade partials under `resources/views/blocks`.

## Filament Resources

The admin panel exposes these resources under the `Theme Builder` navigation group:

- `ThemeResource`
  - Manage themes, active theme status, and settings JSON.
- `ThemeTemplateResource`
  - Manage header, footer, page, landing, single, and archive templates.
- `ThemePageResource`
  - Manage pages, builder data, SEO fields, custom CSS, preview, publish, and unpublish actions.

Admin panel path:

```text
/admin
```

## Routes

Public route:

```text
GET /pages/{slug}
```

Preview route:

```text
GET /admin/theme/pages/{page}/preview
```

Only published pages are public. Draft previews require an authenticated user with theme page view or update permission.

## Permissions

The module seeds these permissions:

- `theme.themes.view`
- `theme.themes.create`
- `theme.themes.update`
- `theme.themes.delete`
- `theme.templates.view`
- `theme.templates.create`
- `theme.templates.update`
- `theme.templates.delete`
- `theme.pages.view`
- `theme.pages.create`
- `theme.pages.update`
- `theme.pages.delete`
- `theme.pages.publish`
- `theme.settings.view`
- `theme.settings.update`

Default role assignment:

- `Super Admin`: all theme permissions.
- `Editor`: page view/create/update/publish plus template view.
- `Customer`: no theme builder admin permissions.

## Setup

The root application registers this package as a Composer path repository:

```json
"hosseinesteki/theme": "^1.0"
```

Run the usual Laravel setup and verification commands:

```bash
composer dump-autoload
php artisan package:discover
php artisan migrate:fresh --seed
php artisan route:list
php artisan test
npm run build
```

## Current Limitations

- The builder UI is a Filament form MVP, not a drag-and-drop editor.
- Public rendering supports `/pages/{slug}` only; there is no front-page or catch-all theme router yet.
- Header and footer templates are seeded and manageable but not globally composed around all public pages yet.
- Theme settings are stored but not fully applied as design tokens.
- The `html` block is trusted-admin only and has no sanitization layer.
- SEO support is limited to page `meta_title` and `meta_description`.

## Next Phase Ideas

- Add a visual drag-and-drop page builder UI.
- Add reusable global header/footer rendering.
- Add front-page routing and optional catch-all page slugs.
- Add theme settings for colors, spacing, typography, and layout presets.
- Integrate deeper SEO schema and sitemap support for theme pages.
- Add media picker integration for image blocks.
- Add revisions, autosave, and safer draft publishing workflows.
