@extends('base')

@section('content')
    <x-layout.screen title="Add Game">
        <x-forms.form action="{{ route('games.store') }}">
            <x-forms.input name="name" label="Name" required />
            <x-forms.text-area name="description" label="Description" />

            <x-forms.select name="storefronts[]"
                            label="Storefronts"
                            required
                            multiple
                            :options="[
                                [
                                    'label' => 'Hello',
                                    'value' => 1,
                                ]
                            ]" />

            <x-forms.select name="platforms[]"
                            label="Platforms"
                            required
                            multiple
                            :options="[
                                [
                                    'label' => 'Hello',
                                    'value' => 1,
                                ]
                            ]" />

            <x-forms.select name="status"
                            label="Status"
                            required
                            :options="[
                                [
                                    'label' => 'Hello',
                                    'value' => 1,
                                ]
                            ]" />

            <x-forms.date-input name="purchase_date" label="Purchase Date" />
            <x-forms.date-input name="release_date" label="Release Date" />

            <x-forms.select name="genres[]"
                            label="Genre"
                            required
                            multiple
                            :options="[
                                [
                                    'label' => 'Hello',
                                    'value' => 1,
                                ]
                            ]" />

            <x-forms.select name="developers[]"
                            label="Developer"
                            required
                            multiple
                            :options="[
                                [
                                    'label' => 'Hello',
                                    'value' => 1,
                                ]
                            ]" />

            <x-forms.select name="publishers[]"
                            label="Publishers"
                            required
                            multiple
                            :options="[
                                [
                                    'label' => 'Hello',
                                    'value' => 1,
                                ]
                            ]" />

            <x-forms.input type="file" name="cover_image" label="Cover" />
            <x-forms.input type="file" name="hero_image" label="Hero Image" />
        </x-forms.form>
    </x-layout.screen>
@endsection
