@extends('base')

@section('content')
    <x-layout.screen>
        <div class="position-relative mx-n3">
            <picture>
                <source media="(max-width: 576px)" srcset="https://placehold.it/800x400" />
                <img alt="Podcast Name" class="w-100" src="https://placehold.it/1200x400">
            </picture>

            <div class="bg-overlay position-absolute top-0 start-0 w-100 h-100"></div>
        </div>

        <div class="ms-5">
            <div class="row position-relative z-1">
                <div class="col-4 col-lg-3 col-xxl-2">
                    <div class="rounded overflow-hidden"
                         style="margin-top: -200px"
                    >
                        <picture>
                            <source media="(max-width: 576px)" srcset="https://placehold.it/180x180" />
                            <img alt="Podcast Name" class="w-100" src="https://placehold.it/160x160">
                        </picture>
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
                    </ul>
                </div>

                <div class="text-break col-8 col-lg-9 col-xxl-10">
                    <h1 class="display-2 mb-0">{{ $platform->name }}</h1>

                    <div class="d-flex gap-2 mb-2">
                        @if($platform->purchase_date)
                            <span
                                class="badge bg-light text-dark">Purchased {{ $platform->purchase_date->toDateString() }}</span>
                        @endif
                    </div>

                    @if($platform->description)
                        <p class="lead">{{ $platform->description }}</p>
                    @endif
                </div>
            </div>
        </div>
    </x-layout.screen>
@endsection
