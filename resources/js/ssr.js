import { createSSRApp, h } from 'vue'
import { renderToString } from '@vue/server-renderer'
import { createInertiaApp, Link, Head } from '@inertiajs/inertia-vue3'
import MainLayout from './Shared/MainLayout.vue'
import { ZiggyVue } from 'ziggy';
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

        if (page.props?.layout === null) {
            page.layout = undefined;
        }

        return page;
    },
    setup({ app, props, plugin }) {
        return createSSRApp({ render: () => h(app, props) })
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
