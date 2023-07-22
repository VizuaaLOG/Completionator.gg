@extends('base')

@section('content')
    <x-layout.screen :title="empty($genre) ? 'Add Genre' : 'Edit ' . $genre->name">
        <x-forms.form action="{{ !empty($genre) ? route('genres.update', ['genre' => $genre]) : route('genres.store') }}">
            @if(!empty($genre)) @method('PATCH') @endif

            <div>
                <x-forms.input name="name" label="Name" required :value="empty($genre) ? '' : $genre->name" />
            </div>
        </x-forms.form>
    </x-layout.screen>
@endsection
