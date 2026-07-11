@php
    $slides = collect($settings['slides'] ?? [])->filter(fn ($slide) => is_array($slide));
    $height = min(720, max(320, (int) $settings['height']));
    $overlay = min(80, max(0, (int) $settings['overlay']));
    $asset = fn ($path) => $path && !str_starts_with($path, 'http') ? \Illuminate\Support\Facades\Storage::disk('public')->url($path) : $path;
@endphp
<section class="theme-hero-slider" data-theme-block="hero_slider" style="--hero-height:{{ $height }}px;--hero-overlay:{{ $overlay / 100 }}">
    @forelse($slides as $slide)<article class="theme-hero-slide">
        @if($slide['desktop_image'] ?? null)<picture>@if($slide['mobile_image'] ?? null)<source media="(max-width:639px)" srcset="{{ $asset($slide['mobile_image']) }}">@endif<img src="{{ $asset($slide['desktop_image']) }}" alt="" fetchpriority="{{ $loop->first ? 'high' : 'auto' }}"></picture>@endif
        <div class="theme-hero-slide__fallback"></div><x-theme::container><div class="theme-hero-slide__content"><h2>{{ $slide['title'] ?? '' }}</h2>@if($slide['subtitle'] ?? null)<p>{{ $slide['subtitle'] }}</p>@endif @if($slide['button'] ?? null)<x-theme::button :href="$slide['url'] ?? '#'">{{ $slide['button'] }}</x-theme::button>@endif</div></x-theme::container>
    </article>@empty<x-theme::empty-state title="اسلایدی برای نمایش وجود ندارد" />@endforelse
</section>
