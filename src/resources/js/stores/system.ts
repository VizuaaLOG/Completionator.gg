import {defineStore} from 'pinia';
import axios from 'axios';

export const useSystemStore = defineStore('system', {
    state: () => {
        return {
            loading: true,
            setup_complete: false,
            instance_name: '',

            apiEndpoint: '/api/v1',
        };
    },
    actions: {
        async fetchSystemState() {
            return await axios.get(`${this.apiEndpoint}/system`)
                .then((response) => {
                    this.$patch({
                        ...response.data.data,
                        loading: false,
                    })
                });
        },

        async runMigrations() {
            return await axios.post(`${this.apiEndpoint}/system/migrate`);
        }
    }
});
