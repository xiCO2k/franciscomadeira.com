<script setup>
import { usePage } from "@inertiajs/vue3";

const page = usePage();
</script>

<template>
    <nav
        :key="page.url"
        class="flex space-x-4 sm:space-x-8 text-gray-400 text-sm sm:text-base"
    >
        <Link
            href="/given-talks"
            class="link-underline hover:text-gray-100"
            :class="
                route().current('given-talks') ? 'active text-gray-100' : ''
            "
        >
            <span class="hidden sm:inline">Given</span> Talks
        </Link>
        <Link
            href="/about"
            class="link-underline hover:text-gray-100"
            :class="page.url.startsWith('/about') ? 'active text-gray-100' : ''"
        >
            About
        </Link>
        <a
            href="https://github.com/xico2k"
            target="_blank"
            rel="noreferrer"
            class="link-underline hover:text-gray-100"
        >
            GitHub
        </a>
        <a
            href="https://twitter.com/xico2k"
            target="_blank"
            rel="noreferrer"
            class="link-underline hover:text-gray-100"
        >
            Twitter
        </a>
    </nav>
</template>
