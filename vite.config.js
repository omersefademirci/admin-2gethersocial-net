import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import path from 'path';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
            publicDirectory: "public_html"
        }),
    ],
    build: {
        outDir: path.resolve(__dirname, 'public_html'),
        hotFile: "public_html/hot"
    },
    server: {
        host: true,
        fs: {
            strict: false,
        },
    },
});
