# Theme Forensic File Inventory

## Executive finding

The surviving evidence proves that **65 Persian Commerce files were lost**: 16 runtime source files have been recovered exactly and 49 files remain missing. The remaining set is 36 application source files, 8 tests, and 5 documents. No recovered file is classified as approximate.

The statement that 48 files were recovered is not supported by the recovery commit. Commit `ba1e967` added 18 files: 16 runtime source files and 2 newly authored recovery reports; it also modified `vite.config.js`. The claim may have mixed recovered files with pre-existing tracked Theme files, but there is no Git or filesystem record identifying such a 48-file set.

## Repository state

- Root: `C:/Users/hosseinEsteki/Documents/Codex/2026-07-07/you-are-working-on-my-laravel/SiteBuilder`
- Branch: `recovery/persian-commerce-assets`
- Current commit: `ba1e967 Checkpoint recovered Persian Commerce theme assets`
- Tracked repository files: 1,102
- Untracked files: 25, all reported by Git under `recovery-backup/`
- Working tree application changes: none

## Counts

| Measure | Exact count |
|---|---:|
| Current requested-scope files | 93 |
| Current Theme application/config source (`modules/theme`, ThemeBuilder Filament, Vite) | 73 |
| Expected Theme application/config source after recovery | 109 |
| Expected Theme tests | 11 |
| Expected Theme documentation files | 8 |
| Expected Theme corpus (source + Theme tests + Theme docs) | 128 |
| Recovered exactly | 16 |
| Recovered approximately | 0 |
| Still-missing application source | 36 |
| Still-missing tests | 8 |
| Still-missing documentation | 5 |
| Demonstrable files originally lost | 65 |

The 93-file current-scope count includes every existing file under `modules/theme/`, `app/Filament/Resources/ThemeBuilder/`, all of `tests/`, root `THEME_*.md`, and `vite.config.js`. Per-file path, tracking state, type, purpose/evidence, confidence, and byte size are in `THEME_FORENSIC_FILE_INVENTORY.csv`.

## Recovered exactly

The recovery commit contains 12 Blade components and 4 CSS files. Component APIs and markup are supported by compiled Blade output. The rebuilt Theme CSS has the same filename, size, and SHA-256 as the backup production asset.

- `modules/theme/resources/css/{theme,header,footer,homepage}.css`
- `modules/theme/resources/views/components/{badge,button,card,category-card,container,empty-state,heading,image,loading-skeleton,price,product-card,section}.blade.php`

The two recovery reports are new documentation, not recovered historical files. The Vite edit restored a reference but is not counted as a recovered file.

## Missing source files

### Compiled-view-proven Blade views (24)

- Header/navigation: account action, announcement bar, cart action, category menu, mega menu, mobile header, mobile bottom navigation, site logo
- Footer: copyright, footer brand, footer contact, footer links, footer social, newsletter, service features, trust badges
- Homepage/data blocks: brand carousel, category grid, hero slider, posts, product carousel, product search, promotion banner grid
- Template: `modules/theme/resources/views/templates/show.blade.php`

Every item has a canonical original source path embedded in a surviving compiled Blade cache file.

### PHP source supported by the pre-loss inventory/references (12)

- `modules/theme/src/ThemeContext.php`
- Services: `ThemeBlockResolver`, `TemplateResolver`, `ActiveThemeResolver`
- Controllers: `ThemeTemplateController`, `ProductSearchController`
- Facade: `ActiveTheme`
- Data providers: `ProductDataProvider`, `HeaderDataProvider`, `CategoryDataProvider`, `BrandDataProvider`, `BlogDataProvider`

The current `BlockRegistry`, `ThemeRenderer`, `ThemeSeeder`, `BuilderDataField`, provider, routes, and layout are older tracked versions. Their missing Persian Commerce-era content is not counted as additional missing files because the files themselves exist; this report does not attempt content-level reconstruction.

## Missing tests (8)

- `ThemeTemplateResolutionTest.php`
- `PersianCommerceHomepageTest.php`
- `PersianCommerceHeaderTest.php`
- `PersianCommerceFooterTest.php`
- `ThemeProductCardTest.php`
- `ThemeEngineTest.php`
- `ThemeDynamicDataTest.php`
- `PersianCommerceThemeSeederTest.php`

These names are present in the pre-loss test inventory and reconcile the historical 95-test status against the current older suite. `TEST_SUITE_RECOVERY_REPORT.md` is not counted missing because no evidence proves that conditional report was ever created.

## Missing documentation (5)

- `THEME_DESIGN_SYSTEM_STATUS.md`
- `THEME_HEADER_STATUS.md`
- `THEME_PRODUCT_CARD_STATUS.md`
- `THEME_FOOTER_STATUS.md`
- `THEME_HOMEPAGE_STATUS.md`

## Generated and ignored files excluded

Current excluded runtime artifacts total 487 files: 4 under `public/build`, 476 compiled views, 3 logs, 3 bootstrap cache files, and 1 SQLite database. The forensic backup contains another 560 copied/generated evidence files and is also excluded. `vendor`, `node_modules`, uploads, and debugbar output are excluded by definition and were not enumerated as source.

The approximate “92 deleted files” cannot be reproduced from Git or surviving source-path evidence. Its arithmetic residual is 27 (`92 - 65`), but no evidence maps exactly 27 named generated files to that estimate. Therefore the defensible result is: **65 proven lost source/test/documentation files; 487 current generated files and 560 backup artifacts excluded; 27 is an unsupported residual, not a forensic file count.**

## Reference validation

- CSS entry/imports currently resolve.
- Current tracked generic BlockRegistry views resolve.
- Compiled Blade paths prove the 24 absent Persian Commerce views.
- The missing PHP/test/documentation names are absent from both Git and filesystem.
- No duplicate uppercase `Modules/theme` source tree was found.
- Composer maps `Theme\\` to `modules/theme/src/` and `Tests\\` to `tests/`; no alternative source location exists.

## Prioritized recovery plan

1. Recover the 24 compiled-view-proven Blade views from the untouched backup.
2. Recover the 12 PHP orchestration/data files, then reconcile existing older files at content level.
3. Recover the 8 tests and use them as acceptance criteria.
4. Recreate the 5 historical status reports only after source behavior is verified.

## Safest next action

Create a new checkpoint branch from `ba1e967`, preserve `recovery-backup/` unchanged, and perform a separate read-only decompilation plan for the 24 Blade views before writing any source. Do not build, clear views, or run Composer hooks until all compiled evidence needed for reconstruction has been extracted.
