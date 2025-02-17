import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import dotenv from 'dotenv';

dotenv.config();  // Pastikan dotenv di-load

const scripts = [
    'resources/js/bootstrap.js',
    'resources/js/home.js',
    'resources/js/leaderboard.js',
    'resources/js/login.js',
    'resources/js/pricing.js',
    'resources/js/profile.js',
    'resources/js/upload.js',
];

const styles = [
    'resources/css/leaderboard.css',
    'resources/css/login.css',
    'resources/css/navbar-black.css',
    'resources/css/navbar-home.css',
    'resources/css/navbar-white.css',
    'resources/css/payment.css',
    'resources/css/profile.css',
    'resources/css/upload.css',
];

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/bootstrap/app.css',
                'resources/bootstrap/app.js',
                ...scripts,
                ...styles,
            ],
            refresh: true,
        }),
    ],
    server: {
        proxy: {
            '/app': process.env.APP_URL, // Proxy ke APP_URL
        },
    },
});
