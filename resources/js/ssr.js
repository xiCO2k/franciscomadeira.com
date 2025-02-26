import { createInertiaApp, Head, Link } from "@inertiajs/vue3";
import { renderToString } from "@vue/server-renderer";
import twemoji from "@twemoji/api";
import { createSSRApp, h } from "vue";

import { ZiggyVue } from "../../vendor/tightenco/ziggy";
import MainLayout from "./Shared/MainLayout.vue";
import { Shiki } from "./shiki";

const page = JSON.parse(process.argv[2]);

createInertiaApp({
    page,
    render: renderToString,
    resolve: (name) => {
        const pages = import.meta.glob("./Pages/**/*.vue", { eager: true });
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
            .component("Link", Link)
            .component("Head", Head)
            .directive("emoji", {
                beforeMount(el, binding) {
                    el.innerHTML = twemoji.parse(binding.value);
                },
            });
    },
}).then((output) => console.log(JSON.stringify(output))); // eslint-disable-line
