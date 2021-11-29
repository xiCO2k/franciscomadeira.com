import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/inertia-vue3'
import { InertiaProgress } from '@inertiajs/progress'
import { ZiggyVue } from 'ziggy'
import twemoji from 'twemoji'

InertiaProgress.init()

createInertiaApp({
    resolve: name => import(`./Pages/${name}`),
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .directive('emoji', { mounted(el) {
                el.innerHTML = twemoji.parse(el.innerHTML)
            }})
            .mount(el)
    },
})
