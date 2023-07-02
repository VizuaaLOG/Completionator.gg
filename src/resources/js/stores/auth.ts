import {defineStore} from 'pinia';
import axios from 'axios';
import InvalidCredentialsError from '@/errors/InvalidCredentialsError';
import UnauthenticatedError from '@/errors/UnauthenticatedError';

export const ERROR_UNAUTHENTICATED = 1;
export const ERROR_CORRUPTED_SESSION = 2;

export const AUTHENTICATED = 101;

export const useAuthStore = defineStore('auth', {
    state: () => {
        return {
            user: {
                id: null,
                token: '',
                name: '',
                isAdmin: false,
            },

            token_endpoint: '/api/v1/auth/token',
            profile_endpoint: '/api/v1/me',
            logout_endpoint: '/api/v1/auth/sessions/current',
        };
    },
    actions: {
        async init() {
            const savedToken = localStorage.getItem('token');
            if (savedToken) {
                this.user.token = savedToken;

                try {
                    await this._fetchProfile();
                } catch (e) {
                    if (e instanceof UnauthenticatedError) {
                        await this.logout(false);
                        return ERROR_UNAUTHENTICATED;
                    }

                    return ERROR_CORRUPTED_SESSION;
                }

                return AUTHENTICATED;
            } else {
                return ERROR_UNAUTHENTICATED;
            }
        },

        isAuthenticated() {
            return !!this.user.token;
        },

        async login(email: string, password: string) {
            return axios
                .post(this.token_endpoint, {
                    email,
                    password,
                    device_name: this._guessBrowserName(),
                })
                .then(({data}) => {
                    this.user.token = data.data.access_token;
                    localStorage.setItem('token', this.user.token);
                })
                .catch(({response}) => {
                    if (response.status === 422) {
                        // Invalid credentials
                        throw new InvalidCredentialsError(response.data.message);
                    }

                    throw new Error(response.data.message);
                });
        },

        async logout(deleteServerSession = true) {
            // Try to remove the server session if we have been told to
            if (deleteServerSession) {
                await axios.delete(this.logout_endpoint, {
                    headers: {
                        Authorization: `Bearer ${this.user.token}`,
                    }
                }).catch(({response}) => console.error(response));
            }

            localStorage.removeItem('token');

            this.$reset();
        },

        _fetchProfile() {
            if (!this.isAuthenticated()) {
                throw new UnauthenticatedError();
            }

            return axios
                .get(this.profile_endpoint, {
                    headers: {
                        Authorization: `Bearer ${this.user.token}`,
                    }
                }).then(({data}) => {
                    this.user.id = data.data.id;
                    this.user.name = data.data.name;
                    this.user.isAdmin = data.data.is_admin;
                }).catch(({response}) => {
                    if (response.status === 401) {
                        throw new UnauthenticatedError();
                    }

                    console.error(response);
                });
        },

        _guessBrowserName() {
            const agent = window.navigator.userAgent.toLowerCase();

            if (agent.indexOf('edge') > -1) return 'Microsoft Edge';
            if (agent.indexOf('edg') > -1) return 'Microsoft Edge';
            if (agent.indexOf('opr') > -1) return 'Opera';
            if (agent.indexOf('chrome') > -1) return 'Google Chrome';
            if (agent.indexOf('trident') > -1) return 'Internet Explorer';
            if (agent.indexOf('firefox') > -1) return 'Mozilla Firefox';
            if (agent.indexOf('safari') > -1) return 'Apple Safari';

            return 'Unknown Browser';
        }
    }
});
