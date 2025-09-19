import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                //css
                'resources/scss/main.scss',
                'resources/css/app.css',


                //js
                'resources/js/main.js'
            ],
            refresh: true,
        
        }),
        tailwindcss(),
    ],
});
