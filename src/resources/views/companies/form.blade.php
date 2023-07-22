@extends('base')

@section('content')
    <x-layout.screen :title="empty($company) ? 'Add Company' : 'Edit ' . $company->name">
        <x-forms.form action="{{ !empty($company) ? route('companies.update', ['company' => $company]) : route('companies.store') }}">
            @if(!empty($company)) @method('PATCH') @endif

            <div class="row">
                <div class="col-12 col-md-9">
                    <x-forms.input name="name" label="Name" required :value="empty($company) ? '' : $company->name" />
                    <x-forms.text-area name="description" label="Description" :value="empty($company) ? '' : $company->description" />
                    <x-forms.date-input name="established_date" label="Established Date" :value="empty($company) ? '' : $company->established_date" />
                </div>

                <div class="col-12 col-md-3">
                    <x-forms.image-upload name="logo" label="Logo" collection="logo" conversion="default" :entity="!empty($company) ? $company : null" />
                </div>
            </div>
        </x-forms.form>
    </x-layout.screen>
@endsection
