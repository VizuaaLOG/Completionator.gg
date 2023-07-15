<li class="d-flex flex-column gap-1">
    <a href="{{ $route }}"
       @class([
           'menu-link ms-0 text-body text-decoration-none d-flex justify-content-between align-items-center',
           'active' => $active(),
       ])
    >
        <strong class="flex-grow-1">{{ $title }}</strong>

        @if($badge)
            <div class="badge text-bg-secondary">{{ $badge }}</div>
        @endif
    </a>

    @if($children && $children->isNotEmpty())
        <ul class="list-unstyled d-flex flex-column gap-1">
            @foreach($children as $child)
                <x-layout.side-menu.side-menu-item
                    :title="$child->title"
                    :route="$child->route"
                    :badge="$child->badge ?? null" />
            @endforeach
        </ul>
    @endif
</li>
