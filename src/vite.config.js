import {defineConfig} from 'vite';
import laravel from 'laravel-vite-plugin';
import {fileURLToPath, URL} from 'node:url'
import vue from '@vitejs/plugin-vue'

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/js/main.ts'],
            refresh: true,
        }),
        vue({
            transformAssetUrls: {
                base: null,
                includeAbsolute: false,
            },
        }),
    ],
    resolve: {
        alias: {
            '@': fileURLToPath(new URL('./resources/js', import.meta.url)),
            '~': fileURLToPath(new URL('./node_modules', import.meta.url)),
        }
    },
});
