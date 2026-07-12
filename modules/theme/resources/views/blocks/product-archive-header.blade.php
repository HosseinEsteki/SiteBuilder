@php
    $title = $archiveTitle ?? 'فروشگاه';
    $description = $archiveDescription ?? null;
    $image = $archiveImage ?? null;
    $query = $searchQuery ?? null;
    $alignment = in_array($settings['alignment'] ?? 'right', ['right', 'center', 'left'], true) ? $settings['alignment'] : 'right';
    $variant = ($settings['variant'] ?? 'default') === 'compact' ? 'compact' : 'default';
@endphp
@if($settings['show_breadcrumbs'] ?? true)
    <nav class="theme-archive-breadcrumbs theme-container" aria-label="مسیر صفحه">
        <a href="{{ route('theme.homepage') }}">خانه</a><span aria-hidden="true">/</span>
        @if($currentCategory ?? null)<a href="{{ route('theme.shop') }}">فروشگاه</a><span aria-hidden="true">/</span>@endif
        <span aria-current="page">{{ $title }}</span>
    </nav>
@endif
<header class="theme-archive-header theme-archive-header--{{ $variant }} theme-archive-header--{{ $alignment }}" data-theme-block="product_archive_header">
    <x-theme::container>
        @if(($settings['show_image'] ?? true) && $image)<img src="{{ $image }}" alt="تصویر {{ $title }}" loading="lazy">@endif
        <div><h1>{{ $title }}</h1>
            @if($query !== null && $query !== '')<p>نتایج برای «{{ $query }}»</p>@endif
            @if(($settings['show_description'] ?? true) && $description)<p>{{ $description }}</p>@endif
            @if($settings['show_result_count'] ?? true)<p class="theme-archive-header__count" aria-live="polite">{{ number_format($resultCount ?? 0) }} نتیجه</p>@endif
        </div>
    </x-theme::container>
</header>
