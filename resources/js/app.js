import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue';
import PrimeVue from 'primevue/config';
import Aura from '@primevue/themes/aura';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';
import 'primeicons/primeicons.css'

import Button from "primevue/button"
import Badge from "primevue/badge"
import SplitButton from 'primevue/splitbutton';
import Toast from 'primevue/toast';
import ToastService from 'primevue/toastservice';

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .use(PrimeVue, {
                theme: {
                    preset: Aura
                }
            })
            .use(ToastService)
            .component('Button', Button)
            .component('Badge', Badge)
            .component('SplitButton', SplitButton)
            .component('Toast', Toast)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
