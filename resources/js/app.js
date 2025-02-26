import "../css/app.css";

import { createInertiaApp, Head, Link } from "@inertiajs/vue3";
import twemoji from "@twemoji/api";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import { createApp, h } from "vue";

import { ZiggyVue } from "../../vendor/tightenco/ziggy";
import MainLayout from "./Shared/MainLayout.vue";
import { Shiki } from "./shiki";

createInertiaApp({
    resolve: async (name) => {
        const page = (
            await resolvePageComponent(
                `./Pages/${name}.vue`,
                import.meta.glob("./Pages/**/*.vue"),
            )
        ).default;

        if (page.layout === undefined) {
            page.layout = MainLayout;
        }

        return page;
    },
    title: (title) => {
        const defaultTitle = "Francisco Madeira";

        if (!title || title === defaultTitle) {
            return defaultTitle;
        }

        return `${title} - ${defaultTitle}`;
    },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(Shiki)
            .use(ZiggyVue)
            .component("Link", Link)
            .component("Head", Head)
            .directive("emoji", {
                mounted(el) {
                    el.innerHTML = twemoji.parse(el.innerHTML);
                },
            })
            .mount(el);
    },
});
