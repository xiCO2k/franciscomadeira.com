import { getHighlighter, setCDN } from 'shiki';
import { ref } from 'vue'

const isServer = typeof window === 'undefined'
setCDN('/shiki/')

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

        const langs = ['html', 'php', 'js', 'json', 'vue', 'sh', {
            id: 'blade',
            scopeName: 'text.html.php.blade',
            path: (isServer ? '../../public/shiki/' : '') + 'languages/blade.tmLanguage.json',
            embeddedLangs: ['html', 'php'],
        }];
        highlighter = await getHighlighter({ theme, langs });

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

        return highlighter.codeToThemedTokens(text, lang, theme);
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
