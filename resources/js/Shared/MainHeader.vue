<template>
    <header class="pt-6 sm:pt-8 px-6 sm:px-8 flex w-full max-w-7xl items-center justify-between mb-4 sm:mb-8">
        <Link
            :href="route('home')"
            class="flex items-center text-gray-400 hover:text-white"
        >
            <picture>
                <source type="image/webp" srcset="/og-square.webp">
                <img
                    src="/og-square.jpg"
                    class="w-14 h-14 sm:w-20 sm:h-20 border-4 sm:border-4 border-gray-800 rounded-full"
                    alt="Francisco Madeira"
                >
            </picture>
            <div class="hidden sm:block ml-4 font-bold text-lg">
                Francisco Madeira
            </div>
        </Link>
        <MainNav />
    </header>
</template>

<script setup>
import MainNav from './MainNav'
</script>
