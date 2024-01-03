<script setup>
import { ref, onMounted, useSlots, watch, inject } from 'vue';

const props = defineProps({
    lang: String,
    name: String,
    lineNumbers: Boolean,
})

const lines = ref('');
const slots = useSlots();
const highlighter = inject('highlighter');

highlighter.install();
onMounted(() => setCode());
watch(highlighter.loaded, () => setCode());

const setCode = () => {
    lines.value = highlighter.getLines(
        slots.default().map(element => element.children).join('').replace(/\n$/, ''),
        props.lang,
    );
}

const tokenFontStyle = ({ fontStyle }) => ({
    2: 'font-bold',
    1: 'italic',
    4: 'underline',
})[fontStyle];
</script>

<template>
    <div class="code-snippet w-full">
        <div class="px-6 pt-4 pb-2 bg-black rounded-lg bg-opacity-60 w-full">
            <div class="flex justify-center items-center relative h-6">
                <div v-if="name" class="hidden sm:block text-gray-400 text-xs sm:text-sm">
                    {{ name }}
                </div>
                <div class="absolute left-0 flex items-center gap-2">
                    <div class="w-3 h-3 rounded-full bg-red-600" />
                    <div class="w-3 h-3 rounded-full bg-yellow-500" />
                    <div class="w-3 h-3 rounded-full bg-green-500" />
                </div>
                <div class="absolute right-0 text-xs text-gray-400 font-bold uppercase">
                    {{ lang }}
                </div>
            </div>
            <div class="font-mono py-4 text-xs leading-6 sm:text-sm sm:leading-8 overflow-auto whitespace-pre scrollbar:w-2 scrollbar:h-2 scrollbar-track:bg-transparent scrollbar-thumb:rounded scrollbar-thumb:bg-gray-900">
                <span
                    v-for="(line, lineIndex) in lines"
                    :key="`line-${lineIndex}`"
                    class="line"
                >
                    <span
                        v-if="lineNumbers"
                        class="number hidden sm:inline-block"
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
            </div>
        </div>
    </div>
</template>
