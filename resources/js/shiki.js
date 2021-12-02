import { getHighlighter, setCDN } from 'shiki';
import { ref } from 'vue'

setCDN('https://unpkg.com/shiki/')

export const highlighter = () => {
    const theme = 'github-dark';
    const loaded = ref(false);
    let highlighter;

    const install = async () => {
        if (highlighter) {
            return;
        }

        highlighter = await getHighlighter({
            theme,
            langs: ['html', 'xml', 'sql', 'javascript', 'typescript', 'json', 'css', 'php'],
        });

        loaded.value = true;

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
