@extends('base')

@section('content')
    <x-layout.screen :title="empty($dlc) ? 'Add DLC - ' . $game->name : 'Edit ' . $dlc->name">
        <x-forms.form :action="!empty($dlc) ? route('downloadable_content.update', ['game' => $game, 'downloadable_content' => $dlc]) : route('downloadable_content.store', ['game' => $game])">
            @if(!empty($dlc)) @method('PATCH') @endif

            <div class="row">
                <div class="col-12 col-md-9">
                    <x-forms.input name="name" label="Name" required :value="empty($dlc) ? '' : $dlc->name" />
                    <x-forms.text-area name="description" label="Description" :value="empty($dlc) ? '' : $dlc->description" />

                    <x-forms.select name="storefronts[]"
                                    label="Storefronts"
                                    required
                                    multiple
                                    :options="$storefronts"
                                    :value="empty($dlc) ? '' : $dlc->storefronts()->pluck('storefronts.id')" />

                    <x-forms.select name="platforms[]"
                                    label="Platforms"
                                    required
                                    multiple
                                    :options="$platforms"
                                    :value="empty($dlc) ? '' : $dlc->platforms()->pluck('platforms.id')" />

                    <x-forms.select name="status_id"
                                    label="Status"
                                    required
                                    :options="$statuses"
                                    :value="empty($dlc) ? '' : $dlc->status_id" />

                    <x-forms.select name="priority_id"
                                    label="Priority"
                                    :options="$priorities"
                                    :value="empty($dlc) ? '' : $dlc->priority_id" />

                    <x-forms.date-input name="purchase_date" label="Purchase Date" :value="empty($dlc) ? '' : $dlc->purchase_date" />
                    <x-forms.date-input name="release_date" label="Release Date" :value="empty($dlc) ? '' : $dlc->release_date" />

                    <x-forms.select name="genres[]"
                                    label="Genre"
                                    required
                                    multiple
                                    :options="$genres"
                                    :value="empty($dlc) ? '' : $dlc->genres()->pluck('genres.id')" />

                    <x-forms.select name="developers[]"
                                    label="Developer"
                                    required
                                    multiple
                                    :options="$companies"
                                    :value="empty($dlc) ? '' : $dlc->developers()->pluck('companies.id')" />

                    <x-forms.select name="publishers[]"
                                    label="Publishers"
                                    required
                                    multiple
                                    :options="$companies"
                                    :value="empty($dlc) ? '' : $dlc->publishers()->pluck('companies.id')" />
                </div>

                <div class="col-12 col-md-3">
                    <x-forms.image-upload name="cover" label="Cover" collection="cover" conversion="default" :entity="!empty($dlc) ? $dlc : null" />
                    <x-forms.image-upload name="hero" label="Hero" collection="hero" conversion="default" :entity="!empty($dlc) ? $dlc : null" />
                </div>
            </div>
        </x-forms.form>
    </x-layout.screen>
@endsection
