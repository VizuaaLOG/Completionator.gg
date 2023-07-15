@extends('base')

@section('content')
    <x-layout.screen title="Plaforms">
        <div class="row flex-nowrap overflow-x-auto pb-3">
            @foreach($platforms as $platform)
                <div class="col-3 col-lg-3 col-xxl-1">
                    <a href="{{ route('platforms.show', ['platform' => $platform]) }}"
                       class="text-decoration-none rounded"
                    >
                        <div class="rounded overflow-hidden mb-2">
                            <picture>
                                <source media="(max-width: 576px)" srcset="https://placehold.it/180x180" />
                                <img alt="Podcast Name" class="w-100" src="https://placehold.it/240x240">
                            </picture>
                        </div>

                        <h3 class="fs-6 fw-normal mb-1 text-body">{{ $platform->name }}</h3>
                        @if($platform->manufacturer)
                            <p class="mb-0 text-muted">{{ $platform->manufacturer }}</p>
                        @endif
                    </a>
                </div>
            @endforeach
        </div>
    </x-layout.screen>
@endsection
