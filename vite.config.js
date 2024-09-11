import { defineConfig } from 'vite';
import vue from '@vitejs/plugin-vue';
import laravel from 'laravel-vite-plugin';
import { resolve } from 'path';  // Импорт path для настройки алиасов

export default defineConfig({
    plugins: [
        vue(),
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    resolve: {
        alias: {
            'vue': 'vue/dist/vue.esm-bundler.js'  // Алиас для Vue с поддержкой runtime-компиляции
        }
    }
});
