import { getHighlighterCore } from 'shiki/core'
import getWasm from 'shiki/wasm'
import { ref } from 'vue'

export const highlighter = () => {
    const loaded = ref(false);
    const loading = ref(false);
    let highlighter;

    const install = async () => {
        if (highlighter || loading.value) {
            return;
        }

        loading.value = true;

        highlighter = await getHighlighterCore({
            themes: [
                () => import('shiki/dist/themes/github-dark.mjs'),
            ],
            langs: [
                () => import('shiki/dist/langs/html.mjs'),
                () => import('shiki/dist/langs/php.mjs'),
                () => import('shiki/dist/langs/javascript.mjs'),
                () => import('shiki/dist/langs/json.mjs'),
                () => import('shiki/dist/langs/vue.mjs'),
                () => import('shiki/dist/langs/shellscript.mjs'),
                () => import('shiki/dist/langs/blade.mjs'),
            ],
            loadWasm: getWasm,
        });

        loaded.value = true;
        loading.value = false;

        return highlighter;
    }

    const getLines = (text, lang) => {
        if (! highlighter) {
            return text.split(/\n/g).map((line) => ([{
                color: '',
                content: line,
            }]));
        }

        return highlighter.codeToTokensBase(text, {
            lang,
            theme: 'github-dark',
        });
    }

    return { install, getLines, loaded }
}

export const Shiki = {
    install: (app, shouldInstall = false) => {
        const instance = highlighter();
        app.provide('highlighter', instance);

        if (shouldInstall) {
            instance.install();
        }
    },
}
