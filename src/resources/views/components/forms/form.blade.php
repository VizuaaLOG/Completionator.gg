<form action="{{ $action }}"
      method="{{ $method }}"
      novalidate
      autocomplete="off"
>
    @csrf

    @if(
        $errors->isNotEmpty()
        && !$errors->has('message')
    )
        @if(config('app.debug'))
            <x-alert :type="\App\Enums\Components\AlertType::Info">
                <strong>Validation Errors</strong>
                <pre>{{ $errors->toJson() }}</pre>

                <strong>Old Output</strong>
                <pre>@json(old())</pre>

                <span class="fst-italic">You are seeing this as debug is enabled in your environment file.</span>
            </x-alert>
        @endif

        <x-alert :type="\App\Enums\Components\AlertType::Danger"
                 message="The form has errors. Please see details below" />
    @elseif($errors->has('message'))
        <x-alert :type="\App\Enums\Components\AlertType::Danger"
                 :message="$errors->get('message')" />
    @endif

    @if(Session::has('success'))
        <x-alert :type="\App\Enums\Components\AlertType::Success"
                 :message="Session::get('success')" />

        @php Session::forget('success') @endphp
    @endif

    {{ $slot }}

    <div class="d-flex justify-content-end w-100 bg-dark-subtle px-3 py-3 rounded">
        <button class="btn btn-primary">Save</button>
    </div>
</form>
