<script setup lang="ts">
    import {useGlobalStore} from '@/stores/global';
    import {useField, useForm} from 'vee-validate';
    import {toTypedSchema} from '@vee-validate/zod';
    import * as zod from 'zod';
    import {computed, ref} from 'vue';
    import {AxiosError} from 'axios';
    import {useAuthStore} from '@/stores/auth';
    import router from '@/router';

    const globalStore = useGlobalStore();
    const authStore = useAuthStore();
    const error = ref('');

    const showLoginModal = computed(() => {
        return !globalStore.loading
            && !globalStore.showInitialSetup
            && !authStore.authenticated;
    });

    const { handleSubmit, resetForm, isSubmitting } = useForm({
        validationSchema: toTypedSchema(
            zod
                .object({
                    email: zod.string().min(1).email(),
                    password: zod.string().min(1),
                })
        )
    });

    const email = useField('email');
    const password = useField('password');

    const submit = handleSubmit(async (values) => {
        try {
            error.value = '';

            await authStore.login(values.email.toString(), values.password.toString() as string);
            resetForm();
            await router.push('/');
        } catch(e) {
            if(
                e instanceof AxiosError
                && e.response !== undefined
                && e.response.status === 422
            ) {
                error.value = e.response.data.message;
            } else {
                error.value = 'An error occurred. Please try again.';
            }
        }
    });
</script>

<template>
    <v-row justify="center">
        <v-dialog
            v-model="showLoginModal"
            persistent
            class="w-25"
            @submit.prevent="submit"
        >
            <v-form
                @submit.prevent
                :disabled="isSubmitting"
            >
                <v-card title="Login">
                    <v-card-text>
                        <v-alert
                            :icon="false"
                            variant="flat"
                            type="error"
                            class="mb-4"
                            v-show="error"
                        >
                            {{ error }}
                        </v-alert>

                        <v-text-field
                            v-model="email.value.value"
                            label="Email"
                            :error-messages="email.errorMessage.value" />

                        <v-text-field
                            type="password"
                            v-model="password.value.value"
                            label="Password"
                            :error-messages="password.errorMessage.value" />
                    </v-card-text>

                    <v-card-actions>
                        <v-spacer></v-spacer>

                        <v-btn
                            color="blue-darken-1"
                            type="submit"
                            variant="flat"
                            block
                            :loading="isSubmitting"
                        >
                            Login
                        </v-btn>
                    </v-card-actions>
                </v-card>
            </v-form>
        </v-dialog>
    </v-row>
</template>
