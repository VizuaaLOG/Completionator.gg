<div class="mb-3">
    <label for="{{ $nameDot }}" class="form-label">
        {{ $label }}
        @if($attributes->has('required'))
            <sup>*</sup>
        @endif
    </label>

    <div @class([
        'input-group' => $addon->isNotEmpty(),
    ])>
        <textarea
            id="{{ $nameDot }}"
            name="{{ $name }}"
            placeholder="{{ $label }}"
            {{
                $attributes
                    ->class([
                        'form-control',
                        'is-invalid' => $errors->has($name),
                    ])
            }}>{{ $value() }}</textarea>

        {{ $addon }}

        @error($name)
            <p class="invalid-feedback mb-0">{{ $message  }}</p>
        @enderror
    </div>
</div>
