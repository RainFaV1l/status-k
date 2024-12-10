import {defineConfig} from 'vite';
import laravel from 'laravel-vite-plugin';
import collectModuleAssetsPaths from './vite-module-loader.js';

async function getConfig() {
    const paths = [
        'resources/css/app.scss',
        'resources/js/app.js',
    ];

    return defineConfig({
        plugins: [
            laravel({
                input: paths,
                refresh: true,
            })
        ]
    });
}

export default getConfig();
