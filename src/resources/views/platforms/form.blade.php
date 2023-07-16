@extends('base')

@section('content')
    <x-layout.screen :title="empty($platform) ? 'Add Platform' : 'Edit ' . $platform->name">
        <x-forms.form action="{{ !empty($platform) ? route('platforms.update', ['platform' => $platform]) : route('platforms.store') }}">
            @if(!empty($platform)) @method('PATCH') @endif

            <div class="row">
                <div class="col-12 col-md-9">
                    <x-forms.input name="name" label="Name" required :value="empty($platform) ? '' : $platform->name" />
                    <x-forms.input name="manufacturer" label="Manufacturer" :value="empty($platform) ? '' : $platform->manufacturer" />
                    <x-forms.text-area name="description" label="Description" :value="empty($platform) ? '' : $platform->description" />
                    <x-forms.date-input name="purchase_date" label="Purchase Date" :value="empty($platform) ? '' : $platform->purchase_date" />
                    <x-forms.date-input name="release_date" label="Release Date" :value="empty($platform) ? '' : $platform->release_date" />
                </div>

                <div class="col-12 col-md-3">
                    <x-forms.image-upload name="cover" label="Cover" collection="cover" conversion="default" :entity="!empty($platform) ? $platform : null" />
                    <x-forms.image-upload name="hero" label="Hero" collection="hero" conversion="default" :entity="!empty($platform) ? $platform : null" />
                </div>
            </div>
        </x-forms.form>
    </x-layout.screen>
@endsection
