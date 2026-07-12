@props(['article', 'showExcerpt' => true, 'showCategory' => true, 'showDate' => true, 'showImage' => true, 'imageRatio' => '16/9'])
@php($image = $article->logo_url ?: null)
<article {{ $attributes->class('theme-article-card') }}>
    @if($showImage)
        <a class="theme-article-card__media" style="--article-image-ratio: {{ in_array($imageRatio, ['1/1', '4/3', '16/9'], true) ? $imageRatio : '16/9' }}" href="{{ route('articles.show', $article->slug) }}" tabindex="-1" aria-hidden="true">
            @if($image)<img src="{{ $image }}" alt="{{ $article->name }}" loading="lazy">@else<div class="theme-article-card__placeholder" role="img" aria-label="تصویری برای این مقاله موجود نیست">◇</div>@endif
        </a>
    @endif
    <div class="theme-article-card__body">
        <div class="theme-article-card__meta">
            @if($showCategory && $article->category)<span class="theme-article-card__category">{{ $article->category->name }}</span>@endif
            @if($showDate && $article->created_at)<time datetime="{{ $article->created_at->toDateString() }}">{{ $article->created_at->translatedFormat('j F Y') }}</time>@endif
        </div>
        <h2 class="theme-article-card__title"><a href="{{ route('articles.show', $article->slug) }}">{{ $article->name }}</a></h2>
        @if($showExcerpt && $article->description)<p>{{ $article->description }}</p>@endif
    </div>
</article>
