@extends('base')

@section('content')
    <x-layout.screen title="Add Platform">
        <x-forms.form action="{{ route('games.store') }}">
            <x-forms.input name="name" label="Name" required />
            <x-forms.text-area name="description" label="Description" />
            <x-forms.date-input name="purchase_date" label="Purchase Date" />
            <x-forms.date-input name="release_date" label="Release Date" />
            <x-forms.input type="file" name="cover_image" label="Cover" />
            <x-forms.input type="file" name="hero_image" label="Hero Image" />
        </x-forms.form>
    </x-layout.screen>
@endsection
