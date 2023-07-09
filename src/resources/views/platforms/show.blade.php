@extends('base')

@section('content')
    <div class="position-relative">
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
                        <source media="(max-width: 576px)" srcset="https://placehold.it/90x180" />
                        <img alt="Podcast Name" class="w-100" src="https://placehold.it/160x160">
                    </picture>
                </div>

                <ul class="list-group mt-3">
                    <li class="list-group-item d-flex justify-content-between">
                        <strong>Release Date</strong>
                        12/12/2022
                    </li>
                </ul>
            </div>

            <div class="text-break col-8 col-lg-9 col-xxl-10">
                <h1 class="display-2 mb-0">Platform Nmae</h1>
                <div class="d-flex gap-2 mb-2">
                    <span class="badge bg-light text-dark">Bought 12/12/2022</span>
                </div>
                <p class="lead">Deathloop transports players to the lawless island of Blackreef in an eternal struggle between two extraordinary assassins. Explore stunning environments and meticulously designed levels in an immersive gameplay experience that lets you approach every situation any way you like. Hunt down targets all over the island in an effort to put an end to the cycle once and for all, and remember, if at first you don’t succeed… die, die again.</p>
            </div>
        </div>
    </div>
@endsection
