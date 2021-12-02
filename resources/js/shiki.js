import { getHighlighter, setCDN } from 'shiki';
import { ref } from 'vue'

setCDN('https://unpkg.com/shiki/')

export const highlighter = () => {
    const theme = 'github-dark';
    let highlighter = false;
    const loaded = ref(false);

    const install = async () => {
        if (highlighter) {
            return;
        }

        highlighter = await getHighlighter({
            theme,
            langs: ['html', 'xml', 'sql', 'javascript', 'typescript', 'json', 'css', 'php'],
        });

        loaded.value = true;
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

    return {
        install, getLines, loaded,
    }
}

export const Shiki = {
    install: (app) => {
        const instance = highlighter();
        app.provide('highlighter', instance);
        instance.install();
    },
}
