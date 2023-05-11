import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue'


export default defineConfig({
    plugins: [
        vue(),
        laravel({
            input: 'resources/js/app.js', // Используйте ваш основной файл JavaScript
            output: 'public/js/app.js', // Укажите путь и имя для выходного файла
            refresh: true,
        }),
    ],
    build: {
        manifest: true,
        rollupOptions: {
            output: {
                entryFileNames: 'assets/[name].js', // Указываем формат имени файла
                chunkFileNames: 'assets/[name].js', // Указываем формат имени файла
                assetFileNames: 'assets/[name].[ext]', // Указываем формат имени файла
            },
        },
    },
})
