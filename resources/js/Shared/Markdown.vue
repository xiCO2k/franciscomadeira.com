<template>
    <template
        v-for="(line, index) in data"
        :key="index"
    >
        <p v-if="line.tag === 'p'">
            <template
                v-for="(child, childIndex) in line.children"
                :key="`p-${childIndex}`"
            />
        </p>
    </template>
</template>

<script setup>
import { useSlots } from 'vue'
import MarkdownIt from 'markdown-it'
import CodeSnippet from './CodeSnippet'
import { Shiki } from '@/shiki'

const slots = useSlots();
const md = MarkdownIt();

const html = md.parse(
    slots.default().map(element => element.children).join(''),
);

const getData = (tokens) => {
    const arr = [];
    let openTag = {};

    tokens.forEach((token) => {
        if (token.type.endsWith('_open')) {
            openTag = token;
        }

        if (token.type === 'inline' || token.type === 'text') {
            openTag.children.push(token.children ? getData(token.children) : token.content);
        }

        if (openTag.type && token.type === openTag.type.replace('_open', '_close')) {
            arr.push(openTag);
        }

        if (token.type === 'fence') {
            arr.push(token);
        }
    });

    return arr;
}

const data = getData(html);

console.log(data)
</script>
