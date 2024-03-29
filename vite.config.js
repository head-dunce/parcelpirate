import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
    server: {
        host: '159.89.45.79',
        port: 3000, // Default port for Vite, but you can change this if needed
        strictPort: true, // Vite will fail if the port is already in use
        proxy: {
            // Proxy all requests not specifically handled by Vite to the Laravel server
            '/api': 'http://159.89.45.79:8080', // Forward API requests to Laravel
            '^/((?!_vite_|_laravel_).)*$': { // Forward all other requests to Laravel
                target: 'http://159.89.45.79:8080',
                changeOrigin: true,
                secure: false,
            },
        },
    },
});
