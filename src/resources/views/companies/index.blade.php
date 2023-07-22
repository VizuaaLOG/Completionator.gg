@extends('base')

@section('content')
    <x-layout.screen title="Companies">
        <div class="row flex-nowrap overflow-x-auto pb-3">
            @foreach($companies as $company)
                <div class="col-3 col-lg-3 col-xxl-1">
                    <a href="{{ route('companies.show', ['company' => $company]) }}"
                       class="text-decoration-none rounded"
                    >
                        <div class="rounded overflow-hidden mb-2">
                            <img alt="{{ $company->name }}" class="w-100" src="{{ $company->getFirstMediaUrl('logo', 'thumb') }}">
                        </div>

                        <h3 class="fs-6 fw-normal mb-1 text-body">{{ $company->name }}</h3>
                    </a>
                </div>
            @endforeach
        </div>
    </x-layout.screen>
@endsection
