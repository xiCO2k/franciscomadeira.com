import { createSSRApp, h } from 'vue'
import { renderToString } from '@vue/server-renderer'
import { createInertiaApp, Link, Head } from '@inertiajs/inertia-vue3'
import MainLayout from './Shared/MainLayout'
import route from 'ziggy';
import { Shiki } from './shiki'
import twemoji from 'twemoji'

const page = JSON.parse(process.argv[2]);

createInertiaApp({
    page,
    render: renderToString,
    resolve: name => {
        const { default: page } = require(`./Pages/${name}`);

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
            .component('Link', Link)
            .component('Head', Head)
            .directive('emoji', { beforeMount(el, binding) {
                el.innerHTML = twemoji.parse(binding.value)
            }})
            .mixin({
                methods: {
                    route: (name, params, absolute) => {
                        return route(name, params, absolute, {
                            ...page.props.ziggy,
                            location: new URL(page.props.ziggy.url),
                        })
                    },
                },
            });
    },
}).then((output) => console.log(JSON.stringify(output)));
