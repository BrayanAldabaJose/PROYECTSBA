import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import mix from 'laravel-mix';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/css/custom-styles.css',
            ],
            refresh: true,
        }),
    ],
    css: {
        postcss: {
            plugins: [mix],
        },
    },
});
