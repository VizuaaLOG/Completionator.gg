<template>
    <slot></slot>
</template>

<script lang="ts" setup>
    import {provide, reactive, watch} from 'vue';

    const formValidator = reactive({});

    const props = defineProps({
        modelValue: {
            type: Boolean,
            default: false,
        },
    });

    const emit = defineEmits(['update:modelValue']);

    provide('formValidator', formValidator);

    watch(formValidator, (updatedState: { [key: string]: boolean }) => {
        emit('update:modelValue', Object.values(updatedState).filter((val) => !val).length === 0);
    });
</script>
