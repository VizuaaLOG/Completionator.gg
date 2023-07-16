@extends('base')

@section('content')
    <x-layout.screen title="Add Platform">
        <x-forms.form action="{{ !empty($platform) ? route('platforms.update', ['platform' => $platform]) : route('platforms.store') }}">
            @if(!empty($platform)) @method('PATCH') @endif

            <x-forms.input name="name" label="Name" required :value="empty($platform) ? '' : $platform->name" />
            <x-forms.input name="manufacturer" label="Manufacturer" :value="empty($platform) ? '' : $platform->manufacturer" />
            <x-forms.text-area name="description" label="Description" :value="empty($platform) ? '' : $platform->description" />
            <x-forms.date-input name="purchase_date" label="Purchase Date" :value="empty($platform) ? '' : $platform->purchase_date" />
            <x-forms.date-input name="release_date" label="Release Date" :value="empty($platform) ? '' : $platform->release_date" />
            <x-forms.input type="file" name="cover" label="Cover" />
            <x-forms.input type="file" name="hero" label="Hero Image" />
        </x-forms.form>
    </x-layout.screen>
@endsection
