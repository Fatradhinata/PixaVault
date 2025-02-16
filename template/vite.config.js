import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import dotenv from 'dotenv';

dotenv.config();  // Pastikan dotenv di-load

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js', 'resource/js/login.js', 'resource/js/main.js', 'resource/js/profile.js', 'resource/js/home.js'],
            refresh: true,
        }),
    ],
    server: {
        proxy: {
            '/app': process.env.APP_URL, // Proxy ke APP_URL
        },
    },
});
