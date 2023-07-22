@extends('base')

@section('content')
    <x-layout.screen>
        <div class="ms-5 pt-5">
            <div class="row position-relative z-1">
                <div class="col-4 col-lg-3 col-xxl-2">
                    <div>
                        <img alt="{{ $company->name }} Cover Image" class="w-100 rounded" src="{{ $company->getFirstMediaUrl('logo', 'default') }}">
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
                                       href="{{ route('companies.edit', ['company' => $company]) }}"
                                    >
                                        Edit
                                    </a>
                                </li>
                                <li>
                                    <x-delete-entity-button :route="route('companies.destroy', ['company' => $company])" />
                                </li>
                            </ul>
                        </div>
                    </div>

                    <ul class="list-group mt-3">
                        <li class="list-group-item d-flex justify-content-between">
                            <strong>Established Date</strong>
                            {{ $company->established_date?->toDateString() ?? '-' }}
                        </li>
                    </ul>
                </div>

                <div class="text-break col-8 col-lg-9 col-xxl-10">
                    <h1 class="display-2 mb-0">{{ $company->name }}</h1>

                    @if($company->description)
                        <p class="lead">{{ $company->description }}</p>
                    @endif

                    @if($company->developed_games->isNotEmpty())
                        <h2>Developed Games</h2>
                        <div class="row flex-nowrap overflow-x-auto pb-3">
                            @foreach($company->developed_games as $game)
                                <x-games.card :game="$game" />
                            @endforeach
                        </div>
                    @endif

                    @if($company->published_games->isNotEmpty())
                        <h2>Published Games</h2>
                        <div class="row flex-nowrap overflow-x-auto pb-3">
                            @foreach($company->published_games as $game)
                                <x-games.card :game="$game" />
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </x-layout.screen>
@endsection
