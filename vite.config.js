import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';


export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/css/custom-styles.css',
                'resources/css/custom-styles-product.css',
                'resources/css/shoplive-custom.css',

            ],
            refresh: true,
        }),
    ],
    // Elimina la referencia a mix aquí
});
