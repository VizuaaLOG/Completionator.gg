import { defineStore } from 'pinia'
import axios from 'axios';

export const useGlobalStore = defineStore('global', {
    state: () => ({
        loading: true,
        showInitialSetup: false,
    }),
    getters: {},
    actions: {
        async fetchSystem() {
            await axios
                .get('api/v1/system')
                .then((response) => {
                    this.showInitialSetup = !response.data.data.setup_complete;
                })
        }
    },
});
