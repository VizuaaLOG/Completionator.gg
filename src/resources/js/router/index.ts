import {createRouter, createWebHistory} from 'vue-router'
import FirstTimeSetupScreen from '@/screens/FirstTimeSetup/FirstTimeSetupScreen.vue';
import {useAuthStore} from '@/stores/auth';
import HomeScreen from '@/screens/Home/HomeScreen.vue';
import LoginScreen from '@/screens/Login/LoginScreen.vue';
import LibraryScreen from '@/screens/Library/LibraryScreen.vue';
import FavouritesScreen from '@/screens/Favourites/FavouritesScreen.vue';
import CategoriesScreen from '@/screens/Categories/CategoriesScreen.vue';
import games from '@/router/games';

const router = createRouter({
    history: createWebHistory(),
    routes: [
        {
            path: '/',
            name: 'home',
            component: HomeScreen,
        },
        {
            path: '/first-setup',
            name: 'first-setup',
            component: FirstTimeSetupScreen,
        },
        {
            path: '/login',
            name: 'login',
            component: LoginScreen,
            beforeEnter() {
                const authStore = useAuthStore();
                if (authStore.isAuthenticated()) {
                    return {name: 'home', replace: true};
                }
            }
        },
        {
            path: '/library',
            name: 'library',
            component: LibraryScreen,
        },
        {
            path: '/favourites',
            name: 'favourites',
            component: FavouritesScreen,
        },
        {
            path: '/categories',
            name: 'categories',
            component: CategoriesScreen,
        },

        ...games,
    ],
});

router.beforeEach(async (to) => {
    if (to.name === 'first-setup' || to.name === 'login') {
        return true;
    }

    const authStore = useAuthStore();

    if (!authStore.isAuthenticated()) {
        return {name: 'login', replace: true};
    }

    return true;
});

export default router
