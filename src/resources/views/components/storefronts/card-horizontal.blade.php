<div {{
    $attributes->class([
        'card bg-dark-subtle-hover',
    ])
}}>
    <div class="row g-0">
        <div class="col-auto">
            <img src="{{ $storefront->getFirstMediaUrl('icon', 'standard') }}" class="img-fluid rounded-start">
        </div>
        <div class="col-auto">
            <div class="card-body">
                <h5 class="card-title">{{ $storefront->name }}</h5>
            </div>
        </div>
    </div>

    <a href="{{ route('storefronts.show', ['storefront' => $storefront]) }}"
       class="position-absolute w-100 h-100 z-1 top-0 start-0"
    >
        <span class="visually-hidden">View Storefront</span>
    </a>
</div>
