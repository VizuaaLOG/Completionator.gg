<template>
    <div class="card w-25">
        <div class="card-header">
            <h1 class="display-6">Name</h1>
            <p class="lead">Let's start by getting your instance name decided on.</p>
        </div>

        <div class="card-body">
            <p>You can change this later if you change your mind.</p>

            <form-validator v-model="canContinue">
                <form-input v-model="store.instance_name"
                            label="Instance Name"
                            required />
            </form-validator>
        </div>

        <div class="card-footer d-flex justify-content-between">
            <button class="btn btn-dark"
                    @click="$emit('back')"
            >
                Back
            </button>

            <button class="btn btn-primary"
                    :disabled="!canContinue"
                    @click="$emit('continue')"
            >
                Continue
            </button>
        </div>
    </div>
</template>

<script lang="ts" setup>
    import {useInitialSetupStore} from '@/stores/initialSetup';
    import {ref} from 'vue';
    import FormInput from '@/components/form/FormInput.vue';
    import FormValidator from '@/components/form/FormValidator.vue';

    defineEmits(['back', 'continue']);

    const store = useInitialSetupStore();
    const canContinue = ref(false);
</script>
