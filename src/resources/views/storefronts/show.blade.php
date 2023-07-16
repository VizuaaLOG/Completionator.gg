@extends('base')

@section('content')
    <x-layout.screen>
        <div class="d-flex gap-5 align-items-center">
            <div>
                <img alt="{{ $storefront->name }} Icon" class="mw-100 rounded" src="{{ $storefront->getFirstMediaUrl('icon', 'default') }}">
            </div>

            <div class="text-break flex-grow-1">
                <h1 class="display-2 mb-0">{{ $storefront->name }}</h1>
            </div>

            <div class="text-center mt-3">
                <div class="btn-group">
                    <button type="button" class="btn btn-primary dropdown-toggle"
                            data-bs-toggle="dropdown" aria-expanded="false">
                        Actions
                    </button>

                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item"
                               href="{{ route('storefronts.edit', ['storefront' => $storefront]) }}"
                            >
                                Edit
                            </a>
                        </li>
                        <li>
                            <x-delete-entity-button :route="route('storefronts.destroy', ['storefront' => $storefront])" />
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </x-layout.screen>
@endsection
