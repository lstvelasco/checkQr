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
    }
});
