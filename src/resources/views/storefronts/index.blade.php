@extends('base')

@section('content')
    <x-layout.screen title="Storefronts">
        <div class="row flex-nowrap overflow-x-auto pb-3">
            @foreach($storefronts as $storefront)
                <div class="col-auto">
                    <a href="{{ route('storefronts.show', ['storefront' => $storefront]) }}"
                       class="text-decoration-none d-flex gap-3 px-3 py-2 bg-dark-subtle-hover rounded align-items-center"
                    >
                        <img alt="{{ $storefront->name }}" class="rounded" src="{{ $storefront->getFirstMediaUrl('icon', 'default') }}">

                        <div>
                            <h3 class="fs-5 fw-normal mb-1 text-body">{{ $storefront->name }}</h3>
                            <p class="text-muted mb-0">{{ $storefront->games_count }} Games</p>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </x-layout.screen>
@endsection
