@extends('base')

@section('content')
    <x-layout.screen title="Games">
        <div class="row flex-nowrap overflow-x-auto pb-3">
            @foreach($games as $game)
                <x-games.card :game="$game" />
            @endforeach
        </div>
    </x-layout.screen>
@endsection
