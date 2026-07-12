@if($article)<header class="theme-article-header theme-section" data-theme-block="article_header"><div class="theme-reading-container">
    <div class="theme-article-header__meta">@if($settings['show_category'] && $article->category)<span class="theme-article-card__category">{{ $article->category->name }}</span>@endif @if($settings['show_date'] && $article->created_at)<time datetime="{{ $article->created_at->toDateString() }}">{{ $article->created_at->translatedFormat('j F Y') }}</time>@endif @if($settings['show_author'] && $article->author)<span>{{ $article->author->name }}</span>@endif</div>
    <h1>{{ $article->name }}</h1>
    @if($article->description)<p class="theme-article-header__lead">{{ $article->description }}</p>@endif
    @if($settings['show_image'] && $article->logo_url)<img class="theme-article-header__image" src="{{ $article->logo_url }}" alt="{{ $article->name }}">@endif
</div></header>@endif
