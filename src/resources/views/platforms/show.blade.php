@extends('base')

@section('content')
    <x-layout.screen>
        <div class="position-relative mx-n3">
            <img alt="{{ $platform->name }} Hero Image" class="w-100" src="{{ $platform->getFirstMediaUrl('hero', 'default') }}">
            <div class="bg-overlay position-absolute top-0 start-0 w-100 h-100"></div>
        </div>

        <div class="ms-5">
            <div class="row position-relative z-1">
                <div class="col-4 col-lg-3 col-xxl-2">
                    <div style="margin-top: -200px">
                        <img alt="{{ $platform->name }} Cover Image" class="w-100 rounded" src="{{ $platform->getFirstMediaUrl('cover', 'default') }}">
                    </div>

                    <div class="text-center mt-3">
                        <div class="btn-group">
                            <button type="button" class="btn btn-primary dropdown-toggle"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                Actions
                            </button>

                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item"
                                       href="{{ route('platforms.edit', ['platform' => $platform]) }}"
                                    >
                                        Edit
                                    </a>
                                </li>
                                <li>
                                    <x-delete-entity-button :route="route('platforms.destroy', ['platform' => $platform])" />
                                </li>
                            </ul>
                        </div>
                    </div>

                    <ul class="list-group mt-3">
                        <li class="list-group-item d-flex justify-content-between">
                            <strong>Release Date</strong>
                            {{ $platform->release_date?->toDateString() ?? '-' }}
                        </li>

                        <li class="list-group-item d-flex justify-content-between">
                            <strong>Purchase Date</strong>
                            {{ $platform->purchase_date?->toDateString() ?? '-' }}
                        </li>

                        <li class="list-group-item d-flex justify-content-between">
                            <strong>Manufacturer</strong>
                            {{ $platform->manufacturer ?? '-' }}
                        </li>
                    </ul>
                </div>

                <div class="text-break col-8 col-lg-9 col-xxl-10">
                    <h1 class="display-2 mb-0">{{ $platform->name }}</h1>

                    @if($platform->description)
                        <p class="lead">{{ $platform->description }}</p>
                    @endif

                    <h2>Games</h2>
                    <div class="row flex-nowrap overflow-x-auto pb-3">
                        @foreach($platform->games as $game)
                            <x-games.card :game="$game" />
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </x-layout.screen>
@endsection
