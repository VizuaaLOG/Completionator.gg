import '@mdi/font/css/materialdesignicons.css';

import { createApp } from 'vue'
import { createPinia } from 'pinia'
import router from './router'

import 'vuetify/styles';
import { createVuetify } from 'vuetify';
import * as components from 'vuetify/components';
import * as directives from 'vuetify/directives';

import App from './App.vue'
import axios from 'axios';

axios.defaults.withCredentials = true;
axios.defaults.withXSRFToken = true;

const vuetify = createVuetify({
    components,
    directives,
    theme: {
        defaultTheme: 'dark',
    },
});

createApp(App)
    .use(createPinia())
    .use(router)
    .use(vuetify)
    .mount('#app');
