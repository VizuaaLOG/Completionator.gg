<div {{
    $attributes
        ->class([
            'px-3'
        ])
}}>
    @if($title)
        <h1 class="display-2">{{ $title }}</h1>
    @endif

    {{ $slot }}
</div>
