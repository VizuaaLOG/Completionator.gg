<li>
    <a href="{{ $route }}"
       @class([
           'menu-link text-body text-decoration-none',
           'active' => $active(),
       ])
    >
        {{ $title }}

        @if($badge)
            <div class="badge text-bg-secondary">{{ $badge }}</div>
        @endif
    </a>
</li>
