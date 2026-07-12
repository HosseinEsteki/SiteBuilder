# Theme Blog Presentation Status

## Implementation

- Created `blog_archive_grid`, `article_header`, `article_content`, and `related_articles` Theme blocks.
- Created one reusable `article-card` Theme component for archive and related-article cards.
- Reused the Blog module's `ArticleService` for published archive, article detail, and recent same-category article data. Theme's `BlogDataProvider` only adapts resolved controller context for blocks.
- Updated Persian Commerce's published default `blog_archive` and `article` templates idempotently, preserving Theme-level header and footer composition.
- Added responsive one/two/three-column archive grids, controlled image ratios, a constrained article reading width, RTL prose styling, and responsive media.
- Added semantic headings, `article`, `time`, and navigation elements; meaningful image alternatives; visible link focus and body-link treatments; and understandable empty states.

## Compatibility and tests

- Blog API response fields and behavior remain unchanged.
- Focused coverage includes registration, seeded block composition, published/draft visibility, article content, missing optional metadata/image, empty archive, and API compatibility. Existing cross-theme assignment coverage remains in the Theme suite.
- Final test/assertion count: 107 tests passed with 342 assertions.
- Production build passed and `npm audit` reported 0 vulnerabilities.

## Remaining limitations

- Related articles use recent published articles from the same category; no recommendation scoring was added.
- Reading metadata is omitted because the current Blog provider does not supply it.
- Category presentation is text because no public Blog category archive route is currently supplied.

## Recommended commit message

`feat(theme): add Persian Commerce blog presentation blocks`
