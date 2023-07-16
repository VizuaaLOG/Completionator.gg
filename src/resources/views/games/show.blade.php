@extends('base')

@section('content')
    <x-layout.screen>
        <div class="position-relative mx-n3">
            <img alt="{{ $game->name }} Hero Image" class="w-100"
                 src="{{ $game->getFirstMediaUrl('hero', 'default') }}">
            <div class="bg-overlay position-absolute top-0 start-0 w-100 h-100"></div>
        </div>

        <div class="ms-5">
            <div class="row position-relative z-1">
                <div class="col-4 col-lg-3 col-xxl-2">
                    <div style="margin-top: -200px;">
                        <img alt="{{ $game->name }} Cover Image" class="w-100 rounded"
                             src="{{ $game->getFirstMediaUrl('cover', 'default') }}">
                    </div>

                    <div class="text-center mt-3">
                        <div class="btn-group">
                            <button type="button" class="btn btn-primary">Actions</button>
                            <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="visually-hidden">Toggle Dropdown</span>
                            </button>

                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('games.edit', ['game' => $game]) }}">Edit</a></li>
                                <li>
                                    <x-delete-entity-button :route="route('games.destroy', ['game' => $game])" />
                                </li>
                            </ul>
                        </div>
                    </div>

                    <ul class="list-group mt-3">
                        <li class="list-group-item d-flex justify-content-between">
                            <strong>Release Date</strong>
                            {{ $game->release_date?->toDateString() ?? '-' }}
                        </li>

                        <li class="list-group-item d-flex justify-content-between">
                            <strong>Purchase Date</strong>
                            {{ $game->purchase_date?->toDateString() ?? '-' }}
                        </li>

                        <li class="list-group-item d-flex justify-content-between">
                            <strong>Genre</strong>
                            Adventure, Shooter
                        </li>

                        <li class="list-group-item d-flex justify-content-between">
                            <strong>Developer</strong>
                            Arkane Studios
                        </li>

                        <li class="list-group-item d-flex justify-content-between">
                            <strong>Publisher</strong>
                            Bethesda Softworks
                        </li>
                    </ul>

                    <div class="mt-3">
                        <h2>Platforms</h2>

                        @foreach($game->platforms as $platform)
                            <x-platforms.card-horizontal
                                :platform="$platform"
                                @class([
                                    'mb-3' => !$loop->last,
                                ]) />
                        @endforeach
                    </div>

                    <div class="mt-3">
                        <h2>Storefronts</h2>

                        @foreach($game->storefronts as $storefront)
                            <x-storefronts.card-horizontal
                                :storefront="$storefront"
                                @class([
                                    'mb-3' => !$loop->last,
                                ]) />
                        @endforeach
                    </div>
                </div>

                <div class="text-break col-8 col-lg-9 col-xxl-10">
                    <h1 class="display-2 mb-0">{{ $game->name }}</h1>
                    <div class="d-flex gap-2 mb-2">
                        <span class="badge text-bg-{{ $game->status->type }}">{{ $game->status->name }}</span>
                    </div>
                    <p class="lead">{{ $game->description }}</p>
                </div>
            </div>
        </div>
    </x-layout.screen>
@endsection
