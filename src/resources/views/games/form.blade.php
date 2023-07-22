@extends('base')

@section('content')
    <x-layout.screen :title="empty($game) ? 'Add Game' : 'Edit ' . $game->name">
        <x-forms.form :action="!empty($game) ? route('games.update', ['game' => $game]) : route('games.store')">
            @if(!empty($game)) @method('PATCH') @endif

            <div class="row">
                <div class="col-12 col-md-9">
                    <x-forms.input name="name" label="Name" required :value="empty($game) ? '' : $game->name" />
                    <x-forms.text-area name="description" label="Description" :value="empty($game) ? '' : $game->description" />

                    <x-forms.select name="storefronts[]"
                                    label="Storefronts"
                                    required
                                    multiple
                                    :options="$storefronts"
                                    :value="empty($game) ? '' : $game->storefronts()->pluck('storefronts.id')" />

                    <x-forms.select name="platforms[]"
                                    label="Platforms"
                                    required
                                    multiple
                                    :options="$platforms"
                                    :value="empty($game) ? '' : $game->platforms()->pluck('platforms.id')" />

                    <x-forms.select name="status_id"
                                    label="Status"
                                    required
                                    :options="$statuses"
                                    :value="empty($game) ? '' : $game->status_id" />

                    <x-forms.select name="priority_id"
                                    label="Priority"
                                    :options="$priorities"
                                    :value="empty($game) ? '' : $game->priority_id" />

                    <x-forms.date-input name="purchase_date" label="Purchase Date" :value="empty($game) ? '' : $game->purchase_date" />
                    <x-forms.date-input name="release_date" label="Release Date" :value="empty($game) ? '' : $game->release_date" />

                    <x-forms.select name="genres[]"
                                    label="Genre"
                                    required
                                    multiple
                                    :options="$genres"
                                    :value="empty($game) ? '' : $game->genres()->pluck('genres.id')" />

                    <x-forms.select name="developers[]"
                                    label="Developer"
                                    required
                                    multiple
                                    :options="$companies"
                                    :value="empty($game) ? '' : $game->developers()->pluck('companies.id')" />

                    <x-forms.select name="publishers[]"
                                    label="Publishers"
                                    required
                                    multiple
                                    :options="$companies"
                                    :value="empty($game) ? '' : $game->publishers()->pluck('companies.id')" />
                </div>

                <div class="col-12 col-md-3">
                    <x-forms.image-upload name="cover" label="Cover" collection="cover" conversion="default" :entity="!empty($game) ? $game : null" />
                    <x-forms.image-upload name="hero" label="Hero" collection="hero" conversion="default" :entity="!empty($game) ? $game : null" />
                </div>
            </div>
        </x-forms.form>
    </x-layout.screen>
@endsection
