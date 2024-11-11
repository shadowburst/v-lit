import '../css/app.css';
import './bootstrap';

import { createInertiaApp } from '@inertiajs/vue3';
import * as Sentry from '@sentry/vue';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { i18nVue } from 'laravel-vue-i18n';
import { createApp, DefineComponent, h } from 'vue';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) =>
        resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob<DefineComponent>('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        const app = createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue);

        if (import.meta.env.VITE_SENTRY_DSN_PUBLIC && import.meta.env.VITE_SENTRY_DSN_PUBLIC !== 'null') {
            Sentry.init({
                app,
                dsn: import.meta.env.VITE_SENTRY_DSN_PUBLIC,
            });
        }

        app.use(i18nVue, {
            resolve: async (lang: string) => {
                const langs = import.meta.glob('../../lang/*.json');
                return await langs[`../../lang/${lang}.json`]();
            },
            // Mount here so that translations are available when page loads
            onLoad: () => app.mount(el),
        });
    },
    progress: {
        color: 'hsl(var(--primary))',
        showSpinner: true,
    },
});
