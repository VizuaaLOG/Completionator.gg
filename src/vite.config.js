import {defineConfig} from 'vite';
import laravel from 'laravel-vite-plugin';
import {fileURLToPath, URL} from 'node:url'
import vue from '@vitejs/plugin-vue'

export default defineConfig({
    plugins: [
        vue(),
        laravel({
            input: ['resources/js/main.ts', 'resources/scss/app.scss'],
            refresh: true,
        }),
    ],
    resolve: {
        alias: {
            '@': fileURLToPath(new URL('./resources/js', import.meta.url)),
            '~': fileURLToPath(new URL('./node_modules', import.meta.url)),
        }
    }
});
