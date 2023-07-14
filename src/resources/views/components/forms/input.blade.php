<div class="mb-3">
    <label for="{{ $name }}" class="form-label">
        {{ $label }}
        @if($attributes->has('required'))
            <sup>*</sup>
        @endif
    </label>

    <div @class([
        'input-group' => $addon->isNotEmpty(),
    ])>
        <input id="{{ $name }}"
               name="{{ $name }}"
               value="{{ $value() }}"
               {{
                   $attributes
                       ->class([
                           'form-control',
                           'is-invalid' => $errors->has($name),
                       ])->merge([
                           'type'  => 'text',
                       ])
               }}>

        {{ $addon }}

        @error($name)
            <p class="invalid-feedback mb-0">{{ $message  }}</p>
        @enderror
    </div>
</div>
