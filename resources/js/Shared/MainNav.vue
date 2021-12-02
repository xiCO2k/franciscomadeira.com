<template>
    <nav class="flex space-x-8 text-gray-400 text-base">
        <Link
            :href="route('about')"
            class="hover:underline hover:text-gray-100"
        >
            About
        </Link>
        <a
            href="https://github.com/xico2k"
            target="_blank"
            rel="noreferrer"
            class="hover:underline hover:text-gray-100"
        >
            Github
        </a>
        <a
            href="https://twitter.com/xico2k"
            target="_blank"
            rel="noreferrer"
            class="hover:underline hover:text-gray-100"
        >
            Twitter
        </a>
    </nav>
</template>
