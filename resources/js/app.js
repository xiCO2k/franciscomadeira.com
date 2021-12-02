import { createApp, h } from 'vue'
import { createInertiaApp, Link, Head } from '@inertiajs/inertia-vue3'
import { InertiaProgress } from '@inertiajs/progress'
import MainLayout from '@/Shared/MainLayout'
import { ZiggyVue } from 'ziggy'
import { Shiki } from './shiki'
import twemoji from 'twemoji'

InertiaProgress.init()

createInertiaApp({
    resolve: async name => {
        const { default: page } = await import(`./Pages/${name}`);

        if (page.layout === undefined) {
            page.layout = MainLayout;
        }

        if (page.props?.layout === null) {
            page.layout = undefined;
        }

        return page;
    },
    title: title => {
        const defaultTitle = 'Francisco Madeira';
        if (! title || title === defaultTitle) {
            return defaultTitle;
        }

        return `${title} - ${defaultTitle}`;
    },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .use(Shiki)
            .component('Link', Link)
            .component('Head', Head)
            .directive('emoji', { mounted(el) {
                el.innerHTML = twemoji.parse(el.innerHTML)
            }})
            .mount(el)
    },
})
