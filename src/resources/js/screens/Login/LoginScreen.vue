<template>
    <div class="d-flex justify-content-center align-items-center h-100">
        <div class="card w-25">
            <div class="card-header">
                <h1 class="display-6">Login</h1>
            </div>

            <div class="card-body">
                <div v-if="state.error" class="alert alert-danger">{{ state.error }}</div>

                <form-validator v-model="state.canSubmit">
                    <form-input
                        v-model="state.email"
                        label="Email Address"
                        required
                        type="email" />

                    <form-input
                        v-model="state.password"
                        label="Password"
                        required
                        type="password" />
                </form-validator>
            </div>

            <div class="card-footer d-flex justify-content-end">

                <button :disabled="!state.canSubmit || state.loading"
                        class="btn btn-primary"
                        @click="attemptLogin"
                >
                    <span v-if="state.loading"
                          aria-label="Loading"
                          class="spinner-border spinner-border-sm"
                          role="status"></span>
                    Login
                </button>
            </div>
        </div>
    </div>
</template>

<script lang="ts" setup>
    import FormInput from '@/components/form/FormInput.vue';
    import {reactive} from 'vue';
    import FormValidator from '@/components/form/FormValidator.vue';
    import {useAuthStore} from '@/stores/auth';
    import InvalidCredentialsError from '@/errors/InvalidCredentialsError';
    import router from '@/router';

    const state = reactive({
        canSubmit: false,
        loading: false,
        error: '',

        email: '',
        password: '',
    });

    const authStore = useAuthStore();

    async function attemptLogin() {
        state.loading = true;

        try {
            await authStore.login(state.email, state.password);
            await authStore._fetchProfile();
            await router.replace({name: 'home'});
        } catch (e) {
            if (e instanceof InvalidCredentialsError) {
                state.error = e.message;
            } else {
                state.error = 'An error occurred while processing your request. Please try again.';
                console.error(e);
            }

            state.loading = false;
            state.canSubmit = false;
        }
    }
</script>
