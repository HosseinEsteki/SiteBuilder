@extends('theme::layouts.main')
@if(! empty($template->custom_css))
    @push('styles')<style>{{ $template->custom_css }}</style>@endpush
@endif
@section('content')
    <main data-theme-template="{{ $template?->type ?? 'homepage' }}">{!! $renderedContent !!}</main>
@endsection
