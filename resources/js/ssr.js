import { createSSRApp, h } from 'vue'
import { renderToString } from '@vue/server-renderer'
import { createInertiaApp, Link, Head } from '@inertiajs/vue3'
import MainLayout from './Shared/MainLayout.vue'
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';
import { Shiki } from './shiki'
import twemoji from 'twemoji'

const page = JSON.parse(process.argv[2]);

createInertiaApp({
    page,
    render: renderToString,
    resolve: name => {
        const pages = import.meta.globEager('./Pages/**/*.vue');
        const page = pages[`./Pages/${name}.vue`].default;

        if (page.layout === undefined) {
            page.layout = MainLayout;
        }

        return page;
    },
    setup({ App, props, plugin }) {
        return createSSRApp({ render: () => h(App, props) })
            .use(plugin)
            .use(Shiki)
            .use(ZiggyVue, {
                ...page.props.ziggy,
                location: new URL(page.props.ziggy.location),
            })
            .component('Link', Link)
            .component('Head', Head)
            .directive('emoji', { beforeMount(el, binding) {
                el.innerHTML = twemoji.parse(binding.value)
            }});
    },
}).then((output) => console.log(JSON.stringify(output)));
