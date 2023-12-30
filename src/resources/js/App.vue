<script setup lang="ts">
    import {RouterLink, RouterView} from 'vue-router'
    import SetupDialog from '@/components/dialogs/SetupDialog.vue';
    import AppLoader from '@/components/AppLoader.vue';
    import LoginDialog from '@/components/dialogs/LoginDialog.vue';
    import {useAuthStore} from '@/stores/auth';

    const authStore = useAuthStore();
</script>

<template>
    <v-app>
        <v-layout>
            <div v-show="authStore.authenticated">
                <v-navigation-drawer :permanent="true">
                    <v-list-item to="/" title="Home"></v-list-item>
                </v-navigation-drawer>
            </div>

            <v-app-bar
                :order="-1"
                title="Completionator.gg"
                flat
            >
                <template #append>
                    <v-btn
                        v-show="authStore.authenticated"
                        prepend-icon="mdi-plus"
                        variant="flat"
                        color="blue-darken-1"
                        class="mr-3"
                    >
                        Add

                        <v-menu activator="parent">
                            <v-list>
                                <v-list-item :to="{name: 'games.create'}">
                                    <v-list-item-title>Add Game</v-list-item-title>
                                </v-list-item>

                                <v-list-item>
                                    <v-list-item-title>Add Storefront</v-list-item-title>
                                </v-list-item>

                                <v-list-item>
                                    <v-list-item-title>Add Platform</v-list-item-title>
                                </v-list-item>
                            </v-list>
                        </v-menu>
                    </v-btn>

                    <v-btn
                        v-show="authStore.authenticated"
                        icon="mdi-logout"
                        flat
                        @click="authStore.logout()"
                    />
                </template>
            </v-app-bar>

            <v-main class="mx-5 my-2">
                <RouterView v-show="authStore.authenticated" />

                <setup-dialog />
                <login-dialog />
            </v-main>
        </v-layout>

        <app-loader />
    </v-app>
</template>
