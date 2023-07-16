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
                            <img alt="{{ $platform->name }}" class="w-100" src="{{ $platform->getFirstMediaUrl('cover', 'thumb') }}">
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
