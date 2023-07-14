<form action="{{ $action }}"
      method="{{ $method }}"
      novalidate
      autocomplete="off"
>
    @csrf

    @if($errors->isNotEmpty())
        <x-alert :type="\App\Enums\Components\AlertType::Danger"
                 message="The form has errors. Please see details below" />
    @endif

    {{ $slot }}

    <div class="d-flex justify-content-end w-100 bg-dark-subtle px-3 py-3 rounded">
        <button class="btn btn-primary">Save</button>
    </div>
</form>
