import {defineConfig} from 'vite';
import laravel from 'laravel-vite-plugin';
import {fileURLToPath, URL} from 'node:url'

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/js/app.js', 'resources/scss/app.scss'],
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
