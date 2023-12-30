import {defineStore} from 'pinia';
import axios, {AxiosError} from 'axios';
import router from '@/router';

export const useAuthStore = defineStore('auth', {
    state: () => ({
        user: {
            name: '',
            email: '',
            isAdmin: false,
        },
        authenticated: false,
    }),
    actions: {
        async login(email: string, password: string) {
            await axios.get('/sanctum/csrf-cookie');
            await axios
                .post('/login', {
                    email,
                    password,
                });

            await this.getUserDetails();
        },

        async logout() {
            await axios.post('/logout');

            this.$reset();

            await router.push({ name: 'home' });
        },

        async getUserDetails() {
            try {
                const response = await axios.get('/api/v1/me');

                this.$patch({
                    authenticated: true,
                    user: {
                        name: response.data.data.name,
                        email: response.data.data.email,
                        isAdmin: response.data.data.is_admin,
                    }
                });
            } catch(e) {
                if(
                    e instanceof AxiosError
                    && e.status === 401
                ) {
                    this.authenticated = false;
                }
            }
        }
    }
});
