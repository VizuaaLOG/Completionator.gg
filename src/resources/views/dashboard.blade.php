@extends('base')

@section('content')
    <x-layout.screen class="d-flex flex-column gap-5">
        @if($currentlyPlaying->isNotEmpty())
            <div>
                <h2 class="fw-normal">Currently Playing</h2>

                <div class="row">
                    @foreach($currentlyPlaying as $game)
                        <x-games.card :game="$game" />
                    @endforeach
                </div>
            </div>
        @endif

        @if($recentlyAdded->isNotEmpty())
            <div>
                <h2 class="fw-normal">Recently Added</h2>

                <div class="row">
                    @foreach($recentlyAdded as $game)
                        <x-games.card :game="$game" />
                    @endforeach
                </div>
            </div>
        @endif

        @if($recentlyCompleted->isNotEmpty())
            <div>
                <h2 class="fw-normal">Recently Completed</h2>

                <div class="row">
                    @foreach($recentlyCompleted as $game)
                        <x-games.card :game="$game" />
                    @endforeach
                </div>
            </div>
        @endif
    </x-layout.screen>
@endsection
