@extends('base')

@section('content')
    <div class="mb-3 mt-3">
        <h2 class="fw-normal">Currently Playing</h2>

        <div class="row flex-nowrap overflow-x-auto pb-3">
            <div class="col-3 col-lg-3 col-xxl-1">
                <a href="{{ route('games.show', ['game' => 1]) }}"
                   class="text-decoration-none rounded"
                >
                    <div class="rounded overflow-hidden mb-2">
                        <picture>
                            <source media="(max-width: 576px)" srcset="https://placehold.it/90x180" />
                            <img alt="Podcast Name" class="w-100" src="https://placehold.it/160x240">
                        </picture>
                    </div>

                    <h3 class="fs-6 fw-normal mb-1 text-body">Game Name</h3>
                    <p class="mb-0 text-muted">Platform</p>
                </a>
            </div>
        </div>
    </div>
@endsection
