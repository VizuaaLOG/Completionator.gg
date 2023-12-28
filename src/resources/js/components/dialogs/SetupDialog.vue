<script setup lang="ts">
    import {useGlobalStore} from '@/stores/global';
    import {useField, useForm} from 'vee-validate';
    import {toTypedSchema} from '@vee-validate/zod';
    import * as zod from 'zod';
    import {ref} from 'vue';
    import axios from 'axios';
    import {useAuthStore} from '@/stores/auth';

    const globalStore = useGlobalStore();
    const authStore = useAuthStore();

    const stage = ref(1);
    const setupComplete = ref(false);
    const error = ref('');

    const { handleSubmit, resetForm, isSubmitting } = useForm({
        initialValues: {
            adminName: 'admin',
        },
        validationSchema: toTypedSchema(
            zod
                .object({
                    adminName: zod.string().min(1),
                    adminEmail: zod.string().min(1).email(),
                    adminPassword: zod.string().min(1),
                    adminPasswordConfirm: zod.string().min(1)
                })
                .refine((data) => data.adminPassword === data.adminPasswordConfirm, {
                    message: "Passwords do not match.",
                    path: ['adminPasswordConfirm'],
                })
        )
    });

    const adminName = useField('adminName');
    const adminEmail = useField('adminEmail');
    const adminPassword = useField('adminPassword');
    const adminPasswordConfirm = useField('adminPasswordConfirm');

    const submit = handleSubmit(async (values) => {
        try {
            if(!setupComplete.value) {
                await axios
                    .post('/api/v1/initial-setup', {
                        admin: {
                            name: values.adminName,
                            email: values.adminEmail,
                            password: values.adminPassword,
                        }
                    })
                    .then(() => setupComplete.value = true);
            }

            await authStore.login(adminEmail.value.value as string, adminPassword.value.value as string);

            stage.value = 2;

            resetForm();
        } catch(e) {
            error.value = 'An error occurred while completing setup. Please try again.';
        }
    });
</script>

<template>
    <v-row justify="center">
        <v-dialog
            v-model="globalStore.showInitialSetup"
            persistent
            class="w-25"
            @submit.prevent="submit"
        >
            <v-form
                @submit.prevent
                :disabled="isSubmitting"
            >
                <v-card title="Initial Setup">
                    <v-window v-model="stage">
                        <v-window-item :value="1">
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

                                <v-alert
                                    :icon="false"
                                    variant="flat"
                                    type="info"
                                    class="mb-4"
                                >
                                    To get started we need to complete some initial setup.
                                </v-alert>

                                <v-text-field
                                    v-model="adminName.value.value"
                                    label="Admin Name"
                                    :error-messages="adminName.errorMessage.value" />

                                <v-text-field
                                    v-model="adminEmail.value.value"
                                    label="Admin Email"
                                    :error-messages="adminEmail.errorMessage.value" />

                                <v-text-field
                                    type="password"
                                    v-model="adminPassword.value.value"
                                    label="Admin Password"
                                    :error-messages="adminPassword.errorMessage.value" />

                                <v-text-field
                                    type="password"
                                    v-model="adminPasswordConfirm.value.value"
                                    label="Confirm Admin Password"
                                    :error-messages="adminPasswordConfirm.errorMessage.value" />
                            </v-card-text>
                        </v-window-item>

                        <v-window-item :value="2">
                            <v-card-text>
                                <v-alert
                                    variant="flat"
                                    type="success"
                                >
                                    All done! Time to start completing! You have been automatically logged in.
                                </v-alert>
                            </v-card-text>
                        </v-window-item>
                    </v-window>

                    <v-card-actions>
                        <v-spacer></v-spacer>

                        <v-btn
                            color="blue-darken-1"
                            type="submit"
                            variant="flat"
                            block
                            :loading="isSubmitting"
                            v-show="stage === 1"
                        >
                            Save
                        </v-btn>

                        <v-btn
                            color="blue-darken-2"
                            variant="flat"
                            block
                            v-show="stage === 2"
                            @click="globalStore.showInitialSetup = false"
                        >
                            Close
                        </v-btn>
                    </v-card-actions>
                </v-card>
            </v-form>
        </v-dialog>
    </v-row>
</template>
