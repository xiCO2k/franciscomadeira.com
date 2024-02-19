import { getHighlighter } from 'shiki';
import { ref } from 'vue'

export const highlighter = () => {
    const theme = 'github-dark';
    const loaded = ref(false);
    const loading = ref(false);
    let highlighter;


    const install = async () => {
        if (highlighter || loading.value) {
            return;
        }

        loading.value = true;

        const langs = ['html', 'php', 'js', 'json', 'vue', 'sh', 'blade'];
        highlighter = await getHighlighter({ themes: [theme], langs });

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

        return highlighter.codeToTokensBase(text, { lang, theme });
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
