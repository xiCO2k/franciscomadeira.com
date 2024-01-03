<script setup>
import squareImgWebp from 'img/square.webp';
import squareImg from 'img/square.jpg';
import MainNav from './MainNav.vue'
</script>

<template>
    <header class="flex flex-col items-center pt-4 sm:pt-8 px-4">
        <picture>
            <source type="image/webp" :srcset="squareImgWebp">
            <img
                :src="squareImg"
                class="w-36 h-36 sm:w-48 sm:h-48 border-8 border-gray-800 rounded-full mb-8"
                width="192"
                height="192"
                alt="Francisco Madeira"
            >
        </picture>
        <h1
            v-emoji
            class="text-3xl sm:text-6xl font-bold tracking-tight"
        >
            Hello World! 👋
        </h1>
        <h2 class="mt-4 text-lg text-center sm:text-2xl tracking-tight">
            I'm <b>Francisco Madeira</b><br class="sm:hidden"><span class="hidden sm:inline"> - </span> Developer
        </h2>
        <h3
            v-emoji
            class="mt-4 text-sm sm:text-base tracking-tight text-center"
        >
            I build everything with HTML and CSS 👌
        </h3>
        <MainNav class="mt-8" />
    </header>
</template>
