<template>
        <header class="flex flex-col items-center">
            <img src="/og-square.jpg" class="w-36 h-36 sm:w-48 sm:h-48 border-8 border-gray-800 rounded-full mb-8" alt="Francisco Madeira">
            <h1 class="text-3xl sm:text-6xl font-bold tracking-tight">Hello World! 👋</h1>
            <h2 class="mt-4 text-lg text-center sm:text-2xl tracking-tight">I'm <b>Francisco Madeira</b> <br class="sm:hidden"><span class="hidden sm:inline"> - </span>A Software Engineer</h2>
            <h3 class="mt-4 text-sm sm:text-base tracking-tight text-center">I build everything with HTML and CSS 👌</h3>
            <div class="mt-8">
                <a href="https://github.com/xico2k" class="underline mr-1 text-gray-400 hover:text-gray-100">Github</a>
                <a href="https://twitter.com/xico2k" class="underline ml-1 text-gray-400 hover:text-gray-100">Twitter</a>
            </div>
        </header>
        <section class="mt-8 max-w-2xl mx-auto space-y-4 border-t border-gray-800 pt-4">
            <article v-for="post in posts">
                <a href="#" class="flex flex-col bg-gray-900 hover:bg-gray-800 p-8 rounded-xl">
                    <h2 class="font-bold text-3xl mb-4">
                        {{ post.title }}
                    </h2>
                    <p class="text-white text-opacity-50">After 400+ commits, 3 betas, and seven months, Termwind has finally reached its first stable public release…</p>
                    <div class="mt-4">
                        <span>Read more</span>
                    </div>
                </a>
            </article>
        </section>
    </div>
</template>
<script>
import { Head } from '@inertiajs/inertia-vue3'

</script>
