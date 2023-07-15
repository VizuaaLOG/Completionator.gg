<div {{
    $attributes
        ->class([
            'px-3'
        ])
}}>
    @if($errors->has('message'))
        <x-alert :type="\App\Enums\Components\AlertType::Danger"
                 :message="$errors->get('message')" />
    @endif

    @if(Session::has('success'))
        <x-alert :type="\App\Enums\Components\AlertType::Success"
                 :message="Session::get('success')"
                 class="rounded-0 mb-0 mx-n3" />

        @php Session::forget('success') @endphp
    @endif

    @if($title)
        <h1 class="display-2">{{ $title }}</h1>
    @endif

    {{ $slot }}
</div>
