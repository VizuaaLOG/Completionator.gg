<div class="side-menu-wrapper ps-3 py-3 overflow-y-auto">
    <div class="btn-group w-100">
        <a href="{{ route('games.create') }}"
           class="btn btn-primary"
        >
            Add Game
        </a>

        <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split"
                data-bs-toggle="dropdown"
                aria-expanded="false">
            <span class="visually-hidden">Toggle Dropdown</span>
        </button>

        <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Add Collection</a></li>
            <li><a class="dropdown-item" href="{{ route('platforms.create') }}">Add Platform</a></li>
            <li><a class="dropdown-item" href="{{ route('storefronts.create') }}">Add Storefront</a></li>
        </ul>
    </div>

    <ul class="list-unstyled d-flex flex-column gap-4 mt-4">
        <x-layout.side-menu.side-menu-group
            title="Your Dashboard"
            route="dashboard" />

        <x-layout.side-menu.side-menu-group
            title="Library"
            route="games.index" />

        <x-layout.side-menu.side-menu-group
            title="Platforms"
            route="platforms.index"
            :children="$platforms()" />

        <x-layout.side-menu.side-menu-group
            title="Storefronts"
            route="storefronts.index"
            :children="$storefronts()" />
    </ul>
</div>
