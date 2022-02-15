<template>
    <header class="pt-6 sm:pt-8 px-6 sm:px-8 flex flex-col sm:flex-row w-full max-w-7xl items-center sm:justify-between mb-4 sm:mb-8">
        <Link
            :href="route('home')"
            class="flex mb-4 sm:mb-0 items-center text-gray-400 hover:text-white"
        >
            <picture>
                <source type="image/webp" srcset="../../img/square.webp">
                <img
                    src="../../img/square.jpg"
                    class="w-14 h-14 sm:w-20 sm:h-20 border-4 sm:border-4 border-gray-800 rounded-full"
                    width="80"
                    height="80"
                    alt="Francisco Madeira"
                >
            </picture>
            <div class="hidden md:block ml-4 font-bold text-lg">
                Francisco Madeira
            </div>
        </Link>
        <MainNav />
    </header>
</template>

<script setup>
import MainNav from './MainNav.vue'
</script>
