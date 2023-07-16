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
        <select
            id="{{ $nameDot }}"
            name="{{ $name }}"
            @if($multiple)
                multiple
                placeholder="Select option"
            @endif
            {{
                $attributes
                    ->class([
                        'form-select',
                        'tomselect',
                        'is-invalid' => $errors->has($name),
                    ])
            }}
        >
            @if(!$multiple)
                <option value="">Select option</option>
            @endif

            @foreach($options as $option)
                <option value="{{ $option['value'] }}"
                        @disabled($option['disabled'] ?? false)
                        @selected(
                            (
                                !$multiple
                                && $value() == $option['value']
                            ) || (
                                $multiple
                                && $value()->contains($option['value'])
                            )
                        )
                >
                    {{ $option['label'] }}
                </option>
            @endforeach
        </select>

        {{ $addon }}

        @error($name)
            <p class="invalid-feedback mb-0">{{ $message  }}</p>
        @enderror
    </div>
</div>
