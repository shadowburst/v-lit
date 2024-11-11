import { defineConfig, loadEnv } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import i18n from 'laravel-vue-i18n/vite';

export default defineConfig(({ mode }) => {
    const env = loadEnv(mode, process.cwd(), '');
    return {
        plugins: [
            laravel({
                input: 'resources/js/app.ts',
                ssr: 'resources/js/ssr.ts',
                refresh: true,
            }),
            vue({
                template: {
                    transformAssetUrls: {
                        base: null,
                        includeAbsolute: false,
                    },
                },
            }),
            i18n()
        ],
        server: {
            host: true,
            port: parseInt(env.VITE_PORT || '5173'),
            strictPort: true,
            hmr: {
                host: 'localhost',
            },
        },
    };
});
