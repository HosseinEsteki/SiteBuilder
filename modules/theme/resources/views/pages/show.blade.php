@extends('theme::layouts.main')

@if (! empty($page->custom_css))
    @push('styles')
        <style>
            {{ $page->custom_css }}
        </style>
    @endpush
@endif

@section('content')
    <main>
        {!! $renderedContent !!}
    </main>
@endsection
