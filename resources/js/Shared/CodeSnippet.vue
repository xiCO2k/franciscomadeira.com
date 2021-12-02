<template>
    <div class="px-6 pt-4 pb-0 bg-black rounded-lg bg-opacity-60 mt-6">
        <div class="flex justify-between">
            <div class="flex items-center gap-2">
                <div class="w-3 h-3 rounded-full bg-red-600" />
                <div class="w-3 h-3 rounded-full bg-yellow-500" />
                <div class="w-3 h-3 rounded-full bg-green-500" />
            </div>
            <div class="text-xs text-gray-500 font-bold uppercase">
                {{ lang }}
            </div>
        </div>
        <div class="py-4 leading-10">
            <span class="font-mono">
                <span
                    v-for="(line, lineIndex) in lines"
                    :key="`line-${lineIndex}`"
                    :class="$style.line"
                >
                    <span
                        v-if="lineNumbers"
                        :class="$style.number"
                    >{{ lineIndex + 1 }}</span>
                    <span v-if="line.length === 0">&#10;</span>
                    <span
                        v-for="(token, tokenIndex) in line"
                        :key="`token-${tokenIndex}`"
                        :style="{ color: token.color }"
                        :class="tokenFontStyle(token)"
                        v-text="token.content"
                    />
                </span>
            </span>
        </div>
    </div>
</template>
<script setup>
import { ref, onMounted, useSlots, watch, inject } from 'vue';

const props = defineProps({
    lang: String,
    lineNumbers: Boolean,
})

const lines = ref('');
const slots = useSlots();
const highlighter = inject('highlighter');

onMounted(() => setCode());
watch(highlighter.loaded, () => setCode());

const setCode = () => {
    lines.value = highlighter.getLines(
        slots.default().map(element => element.children).join(''),
        props.lang,
    );
}

const tokenFontStyle = ({ fontStyle }) => ({
    2: 'font-bold',
    1: 'italic',
    4: 'underline',
})[fontStyle];

</script>

<style module>
.line {
    display: block;
    width: 100%;

    word-wrap: break-word;
    white-space: pre-wrap;
    word-break: normal;
}

.number {
    width: 1rem;
    white-space: pre;
    margin-right: 1rem;
    display: inline-block;
    text-align: right;

    user-select: none;
    color: rgba(255, 255, 255, 0.3);
}
</style>
