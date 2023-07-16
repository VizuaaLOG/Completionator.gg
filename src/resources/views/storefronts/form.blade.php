@extends('base')

@section('content')
    <x-layout.screen :title="empty($storefront) ? 'Add Storefront' : 'Edit ' . $storefront->name" >
        <x-forms.form action="{{ !empty($storefront) ? route('storefronts.update', ['storefront' => $storefront]) : route('storefronts.store') }}">
            @if(!empty($storefront)) @method('PATCH') @endif

            <div class="row">
                <div class="col-12 col-md-9">
                    <x-forms.input name="name" label="Name" required :value="empty($storefront) ? '' : $storefront->name" />
                </div>

                <div class="col-12 col-md-3">
                    <x-forms.image-upload name="icon" label="Icon" collection="icon" conversion="default" :entity="!empty($storefront) ? $storefront : null" />
                </div>
            </div>
        </x-forms.form>
    </x-layout.screen>
@endsection
