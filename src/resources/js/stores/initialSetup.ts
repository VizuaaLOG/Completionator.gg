import {defineStore} from 'pinia';
import axios from 'axios';

export const useInitialSetupStore = defineStore('initialSetup', {
    state: () => {
        return {
            instance_name: 'Completionist',

            admin_name: '',
            admin_email: '',
            admin_password: '',

            loading: false,

            endpoint: '/api/v1/initial-setup'
        };
    },
    actions: {
        async completeSetup() {
            this.loading = true;

            return axios
                .post(this.endpoint, {
                    system: {
                        instance_name: this.instance_name,
                    },
                    admin: {
                        name: this.admin_name,
                        email: this.admin_email,
                        password: this.admin_password,
                    }
                });
        }
    }
});
