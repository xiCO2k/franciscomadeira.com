<template>
    <nav class="flex space-x-4 sm:space-x-8 text-gray-400 text-sm sm:text-base">
        <Link
            :href="route('about')"
            class="border-b-2 hover:border-blue-300 hover:text-gray-100"
            :class="isUrl('about') ? 'border-blue-300 text-gray-100' : 'border-transparent'"
        >
            About
        </Link>
        <a
            href="https://github.com/xico2k"
            target="_blank"
            rel="noreferrer"
            class="border-b-2 border-transparent hover:border-blue-300 hover:text-gray-100"
        >
            GitHub
        </a>
        <a
            href="https://twitter.com/xico2k"
            target="_blank"
            rel="noreferrer"
            class="border-b-2 border-transparent hover:border-blue-300 hover:text-gray-100"
        >
            Twitter
        </a>
    </nav>
</template>
<script setup>
import { usePage } from '@inertiajs/inertia-vue3';
const page = usePage();

const isUrl = (...urls) => {
    let currentUrl = page.url.value.substr(1);

    if (urls[0] === '') {
        return currentUrl === ''
    }

    return urls.filter(url => currentUrl.startsWith(url)).length
};
</script>
