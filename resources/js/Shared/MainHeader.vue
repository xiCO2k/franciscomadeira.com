<template>
    <header class="flex flex-col items-center">
        <img
            src="/og-square.jpg"
            class="w-36 h-36 sm:w-48 sm:h-48 border-8 border-gray-800 rounded-full mb-8"
            alt="Francisco Madeira"
        >
        <h1
            v-emoji
            class="text-3xl sm:text-6xl font-bold tracking-tight"
        >
            Hello World! 👋
        </h1>
        <h2 class="mt-4 text-lg text-center sm:text-2xl tracking-tight">
            I'm <b>Francisco Madeira</b> <br class="sm:hidden"><span class="hidden sm:inline"> - </span>A Software Engineer
        </h2>
        <h3
            v-emoji
            class="mt-4 text-sm sm:text-base tracking-tight text-center"
        >
            I build everything with HTML and CSS 👌
        </h3>
        <div class="mt-8">
            <a
                href="https://github.com/xico2k"
                target="_blank"
                rel="noreferrer"
                class="underline mr-2 text-gray-400 hover:text-gray-100"
            >Github</a>
            <a
                href="https://twitter.com/xico2k"
                target="_blank"
                rel="noreferrer"
                class="underline ml-2 text-gray-400 hover:text-gray-100"
            >Twitter</a>
        </div>
    </header>
</template>
