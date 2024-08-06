import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    build: {
        rollupOptions: {
            output: {
                manualChunks: {
                    'vendor': ['apexcharts'], // Add other large dependencies if necessary
                }
            }
        },
        chunkSizeWarningLimit: 1000, // Optional: Increase chunk size warning limit
    },
    server: {
        https: true, // Ensure development server uses HTTPS
    },
    base: process.env.APP_URL ? `${process.env.APP_URL}/build/` : '/build/', // Ensure assets are served with correct base URL

});
