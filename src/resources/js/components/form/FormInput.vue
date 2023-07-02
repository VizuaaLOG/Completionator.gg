<template>
    <div :class="{
        'row g-3 mb-3': isInForm,
    }">
        <label v-if="!hideLabel"
               class="form-label col-4 col-form-label"
        >
            {{ label }}
        </label>

        <div :class="{
            'col-8': isInForm,
        }">
            <div class="input-group">
                <input ref="input"
                       :aria-label="label"
                       :class="{
                            'is-invalid': invalid && hasChanged,
                       }"
                       :placeholder="placeholder"
                       :value="modelValue"
                       class="form-control"
                       v-bind="$attrs"
                       @input="changed">

                <slot></slot>
            </div>

            <p v-show="invalid && hasChanged" class="invalid-feedback mb-0">{{ error }}</p>
        </div>
    </div>
</template>

<script lang="ts" setup>
    import {inject, onBeforeUnmount, onMounted, ref} from 'vue';

    const formValidator = inject<{ [key: string]: boolean }>('formValidator');

    const props = defineProps({
        modelValue: {
            type: String,
            default: '',
        },
        label: {
            type: String,
            required: true,
        },
        hideLabel: {
            type: Boolean,
            default: false,
        },
        placeholder: {
            type: String,
            required: false,
        },
        isInForm: {
            type: Boolean,
            default: true,
        },
    });

    const emit = defineEmits([
        'update:modelValue',
    ]);

    const input = ref<null | HTMLInputElement>(null);
    const invalid = ref(false);
    const error = ref('');
    const hasChanged = ref(false);

    function validateField(): boolean {
        invalid.value = !input.value?.validity.valid;

        if (input.value?.validity.valueMissing) {
            error.value = `${props.label} is required`;
            return false;
        }

        if (input.value?.validity.typeMismatch) {
            error.value = `${props.label} is invalid`;
            return false;
        }

        error.value = '';
        return input.value?.validity.valid ?? true;
    }

    function changed() {
        emit('update:modelValue', input.value?.value);
        validateField();
        hasChanged.value = true;

        if (formValidator) {
            formValidator[props.label.replace(' ', '')] = !invalid.value;
        }
    }

    onMounted(() => {
        if (formValidator) {
            formValidator[props.label.replace(' ', '')] = validateField();
        }
    });

    onBeforeUnmount(() => {
        if (formValidator) {
            delete formValidator[props.label.replace(' ', '')];
        }
    });
</script>
