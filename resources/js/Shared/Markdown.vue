<script>
import { useSlots, h, withDirectives, resolveDirective } from 'vue'
import MarkdownIt from 'markdown-it'
import CodeSnippet from './CodeSnippet.vue'

export default {
    setup() {
        const slots = useSlots();
        const md = MarkdownIt({ html: true });

        const html = md.parse(
            slots.default().map(element => element.children).join(''),
            {},
        );

        const parseTokens = (tokens) => {
            let tagOpen = {};
            let data = [];

            tokens.forEach(token => {
                if (! tagOpen.open && token.type.endsWith('_open')) {
                    tagOpen = {
                        open: token,
                        close: null,
                        children: [],
                    };
                } else if (tagOpen?.open?.tag === token.tag && token.type.endsWith('_close')) {
                    tagOpen.close = token;
                    tagOpen.children = parseTokens(tagOpen.children || []);
                    data.push({ ...tagOpen });
                    tagOpen = {};
                } else if (tagOpen.open) {
                    tagOpen.children.push(token);
                } else {
                    data.push({
                        open: token,
                        children: parseTokens(token.children || []),
                    });
                }
            });

            return data;
        }

        const getOutput = (data) => {
            const attrs = (arr) => {
                const args = {};
                arr.forEach(([key, value]) => args[key] = value);
                return args;
            }

            return data.map(({ open, children }) => {
                if (open.tag === 'img') {
                    return h(open.tag, attrs(open.attrs));
                }

                const content = children?.length ? getOutput(children) : open.content;

                if (open.tag === 'a') {
                    return h(open.tag, {
                        ...attrs(open.attrs),
                        rel: 'noreferrer',
                        target: '_blank',
                    }, content);
                }

                if (open.tag === 'p') {
                    return withDirectives(
                        h(open.tag, content),
                        [[resolveDirective('emoji')]]
                    );
                }

                if (open.type === 'fence' && open.tag === 'code') {
                    return h(CodeSnippet, {
                        lang: open.info.split(',')[0],
                        name: open.info.split(',')[1],
                        lineNumbers: true,
                    }, () => open.content);
                }

                if (open.type === 'html_block') {
                    return h('div', {
                        innerHTML: open.content,
                        class: 'mt-6 overflow-hidden w-full aspect-w-16 aspect-h-9'
                    });
                }

                return open.tag
                    ? h(open.tag, content)
                    : content;
            });
        }

        return () => getOutput(parseTokens(html))
    },
}

</script>
