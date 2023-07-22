@extends('base')

@section('content')
    <x-layout.screen title="Genres">
        <div class="row flex-nowrap overflow-x-auto pb-3">
            @foreach($genres as $genre)
                <div class="col-3 col-lg-3 col-xxl-1">
                    <a href="{{ route('genres.show', ['genre' => $genre]) }}"
                       class="text-decoration-none"
                    >
                        <h3 class="fs-6 fw-normal mb-1 text-body bg-dark-subtle rounded p-3">{{ $genre->name }}</h3>
                    </a>
                </div>
            @endforeach
        </div>
    </x-layout.screen>
@endsection
