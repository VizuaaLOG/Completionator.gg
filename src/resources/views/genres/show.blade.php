@extends('base')

@section('content')
    <x-layout.screen>
        <div class="ms-5 pt-5">
            <div class="text-break">
                <h1 class="display-2 mb-0">{{ $genre->name }}</h1>

                @if($genre->games->isNotEmpty())
                    <h2>Games</h2>
                    <div class="row flex-nowrap overflow-x-auto pb-3">
                        @foreach($genre->games as $game)
                            <x-games.card :game="$game" />
                        @endforeach
                    </div>
                @else
                    <div class="alert alert-info">You do not have any games associated with this genre.</div>
                @endif
            </div>
        </div>
    </x-layout.screen>
@endsection
