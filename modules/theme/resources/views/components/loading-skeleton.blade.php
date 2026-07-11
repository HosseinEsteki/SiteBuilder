@props(['lines' => 3])
<div {{ $attributes }} aria-hidden="true">@for($i = 0; $i < $lines; $i++)<div class="theme-skeleton" style="margin-bottom:.5rem"></div>@endfor</div>
