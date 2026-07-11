@php
    $banners = collect($settings['banners'] ?? [])->filter(fn ($banner) => is_array($banner));
    $columns = min(4, max(1, (int) $settings['columns']));
    $asset = fn ($path) => $path && !str_starts_with($path, 'http') ? \Illuminate\Support\Facades\Storage::disk('public')->url($path) : $path;
@endphp
<x-theme::section data-theme-block="promotion_banner_grid"><x-theme::container><div class="theme-promotion-grid" style="--promotion-columns:{{ $columns }}">@forelse($banners as $banner)<a class="theme-promotion" href="{{ $banner['url'] ?? '#' }}">@if($banner['desktop_image'] ?? null)<picture>@if($banner['mobile_image'] ?? null)<source media="(max-width:639px)" srcset="{{ $asset($banner['mobile_image']) }}">@endif<img src="{{ $asset($banner['desktop_image']) }}" alt="{{ $banner['title'] ?? '' }}" loading="lazy"></picture>@else<span class="theme-promotion__fallback"></span>@endif @if($banner['title'] ?? null)<strong>{{ $banner['title'] }}</strong>@endif</a>@empty<x-theme::empty-state title="بنری برای نمایش وجود ندارد" />@endforelse</div></x-theme::container></x-theme::section>
