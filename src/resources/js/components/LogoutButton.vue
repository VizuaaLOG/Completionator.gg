<template>
    <button v-if="authStore.isAuthenticated()"
            class="btn btn-primary"
            @click="logout">Logout
    </button>
</template>

<script lang="ts" setup>
    import {useAuthStore} from '@/stores/auth';
    import router from '@/router';

    const authStore = useAuthStore();

    async function logout() {
        await authStore.logout();
        await router.replace({name: 'login'});
    }
</script>
