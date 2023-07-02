<template>
    <div class="card w-25">
        <div class="card-header">
            <h1 class="display-6">Admin User</h1>
            <p class="lead">Finally, create your admin user.</p>
        </div>

        <div class="card-body">
            <p>Additional admin or non-admin users can be created later.</p>

            <form-validator v-model="canContinue">
                <form-input v-model="store.admin_name"
                            label="Name"
                            required />

                <form-input v-model="store.admin_email"
                            label="Email"
                            required
                            type="email" />

                <form-input v-model="store.admin_password"
                            label="Password"
                            required
                            type="password" />
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
                Complete Setup
            </button>
        </div>
    </div>
</template>

<script lang="ts" setup>
    import {useInitialSetupStore} from '@/stores/initialSetup';
    import {ref} from 'vue';
    import FormValidator from '@/components/form/FormValidator.vue';
    import FormInput from '@/components/form/FormInput.vue';

    defineEmits(['back', 'continue']);

    const store = useInitialSetupStore();
    const canContinue = ref(false);
</script>
