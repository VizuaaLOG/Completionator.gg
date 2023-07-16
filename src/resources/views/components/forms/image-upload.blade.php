<div class="mb-3">
    @if(!empty($entity) && $entity->exists)
        <div class="img-preview mb-2">
            <img src="{{ $entity->getFirstMediaUrl($collection, $conversion) }}" class="rounded mw-100">
        </div>
    @endif

    <label for="{{ $nameDot }}" class="form-label">
        {{ $label }}
        @if($attributes->has('required'))
            <sup>*</sup>
        @endif
    </label>

    <div @class([
        'input-group' => $addon->isNotEmpty(),
    ])>
        <input id="{{ $nameDot }}"
               type="file"
               name="{{ $name }}"
               value="{{ $value() }}"
               placeholder="{{ $label }}"
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
