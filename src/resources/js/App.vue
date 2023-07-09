<template>
    <div class="bg-body h-100 overflow-x-hidden d-flex flex-column">
        <TopBar />

        <div class="row flex-nowrap h-100" style="margin-top: 56px;">
            <div class="col-auto d-none d-md-flex bg-dark-subtle h-100">
                <SideMenu />
            </div>

            <div class="col overflow-y-auto main-content-wrapper pb-5">
                <RouterView />
            </div>
        </div>

        <div class="d-md-none">
            <MobileMenu v-if="authStore.isAuthenticated()" />
        </div>
    </div>

    <AppLoader :active="globalStore.loading" />
</template>

<script lang="ts" setup>
    import {RouterView} from 'vue-router'
    import {onMounted} from 'vue';
    import {useSystemStore} from '@/stores/system';
    import AppLoader from '@/components/AppLoader.vue';
    import router from '@/router';
    import {AUTHENTICATED, ERROR_CORRUPTED_SESSION, ERROR_UNAUTHENTICATED, useAuthStore} from '@/stores/auth';
    import {useGlobalStore} from '@/stores/global';
    import TopBar from '@/components/appFrame/TopBar.vue';
    import SideMenu from '@/components/appFrame/SideMenu.vue';
    import MobileMenu from '@/components/appFrame/MobileMenu.vue';

    const systemStore = useSystemStore();
    const globalStore = useGlobalStore();
    const authStore = useAuthStore();

    onMounted(async () => {
        await systemStore.fetchSystemState();
        if (!systemStore.setup_complete) {
            await router.replace({name: 'first-setup'});
            globalStore.loading = false;

            return;
        }

        // Restore auth
        if (!authStore.isAuthenticated()) {
            switch (await authStore.init()) {
                case ERROR_CORRUPTED_SESSION:
                    alert('You appear to have a potentially corrupted session. Please try clearing the browser data and re-login.');
                    await router.replace({name: 'login'});
                    break;
                case ERROR_UNAUTHENTICATED:
                    await router.replace({name: 'login'});
                    break;
                case AUTHENTICATED:
                    await router.replace({name: 'home'});
                    break;
            }

            globalStore.loading = false;

            return;
        }
    });
</script>

<style lang="scss" scoped>
    .main-content-wrapper {
        max-height: calc(100vh - 56px);
    }
</style>
