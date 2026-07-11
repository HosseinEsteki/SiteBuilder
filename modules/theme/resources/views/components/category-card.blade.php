@props(['category', 'productCount' => null])
@php($count = $productCount ?? $category->products_count ?? null)
<x-theme::card {{ $attributes->class('theme-category-card') }}>@if($category->logo_url)<x-theme::image class="theme-category-card__image" :src="$category->logo_url" :alt="$category->name" />@endif<div class="theme-card__body"><h3 class="theme-product-card__title">{{ $category->name }}</h3>@if($count !== null)<small>{{ number_format($count) }} محصول</small>@endif</div></x-theme::card>
