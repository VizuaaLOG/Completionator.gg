<script setup lang="ts">
    import {computed, ref} from 'vue';
    import {useDate} from 'vuetify';

    const props = defineProps({
        label: String,
        placeholder: String,
        modelValue: String,
    });

    defineEmits([
        'update:modelValue'
    ]);

    const dateAdaptor = useDate();
    const pickerModalOpen = ref(false);

    const modelValueAsDate = computed(() => {
        if(!props.modelValue) {
            return undefined;
        }

        return dateAdaptor.parseISO(props.modelValue);
    })
</script>

<template>
    <v-text-field
        :label="label"
        :placeholder="placeholder"
        :model-value="modelValue"
        append-inner-icon="mdi-calendar"
        @update:model-value="$emit('update:modelValue', $event)"
        @click:append-inner="pickerModalOpen = true"
    />

    <v-dialog
        v-model="pickerModalOpen"
        width="auto"
    >
        <v-card>
            <v-date-picker
                :model-value="modelValueAsDate"
                @update:model-value="$emit('update:modelValue', dateAdaptor.toISO($event))" />

            <v-card-actions>
                <v-btn
                    color="blue-darken-1"
                    variant="flat"
                    block
                    @click="pickerModalOpen = false"
                >
                    Close
                </v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>
