import {createRouter, createWebHistory, START_LOCATION} from 'vue-router'
import HomeView from '@/views/HomeView.vue';
import {useAuthStore} from '@/stores/auth';
import {useGlobalStore} from '@/stores/global';

const router = createRouter({
    history: createWebHistory(),
    routes: [
        {
            path: '/',
            name: 'home',
            component: HomeView,
            meta: { requiresAuth: true },
        },
    ]
});

router.beforeEach(async (to, from, next) => {
    const authStore = useAuthStore();

    if(from === START_LOCATION) {
        const globalStore = useGlobalStore();

        globalStore.loading = true;

        await globalStore.fetchSystem();
        await authStore.getUserDetails();

        globalStore.loading = false;
    }

    return next();
});

export default router
