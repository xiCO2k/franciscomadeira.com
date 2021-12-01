<template>
    <header class="flex w-full max-w-7xl items-center justify-between mb-16">
        <a
            :href="route('index')"
            class="flex items-center"
        >
            <img
                src="/og-square.jpg"
                class="w-18 h-18 sm:w-20 sm:h-20 border-4 border-gray-800 rounded-full"
                alt="Francisco Madeira"
            >
            <div class="ml-4 font-bold text-2xl">Francisco Madeira</div>
        </a>
        <MainNav />
    </header>
</template>

<script setup>
import MainNav from './MainNav'
</script>
