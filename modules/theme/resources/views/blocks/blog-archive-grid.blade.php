<section class="theme-blog-archive theme-section" data-theme-block="blog_archive_grid"><div class="theme-container">
    <header class="theme-blog-archive__header"><h1>{{ $settings['heading'] }}</h1>@if($settings['description'])<p>{{ $settings['description'] }}</p>@endif</header>
    <div class="theme-article-grid" style="--article-columns: {{ min(4, max(1, (int) $settings['columns'])) }}">
        @forelse($articles as $article)<x-theme::article-card :article="$article" :show-excerpt="(bool) $settings['show_excerpt']" :show-category="(bool) $settings['show_category']" :show-date="(bool) $settings['show_date']" :show-image="(bool) $settings['show_image']" :image-ratio="$settings['image_ratio']" />
        @empty<x-theme::empty-state title="هنوز مقاله‌ای منتشر نشده است" />@endforelse
    </div>
    @if($articles instanceof \Illuminate\Contracts\Pagination\Paginator && $articles->hasPages())<nav class="theme-blog-pagination" aria-label="صفحه‌بندی مقاله‌ها">{{ $articles->onEachSide(1)->links() }}</nav>@endif
</div></section>
