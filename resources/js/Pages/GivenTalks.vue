<template>
    <Head title="Given Talks">
        <meta property="og:title" content="Given Talks">
        <meta property="og:description" content="All my given talks available online.">
        <meta property="og:type" content="website">
        <meta property="og:url" content="https://franciscomadeira.com/">
        <meta property="og:image" content="https://franciscomadeira.com/og-pic.jpg">
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:site" content="@xico2k">
        <meta name="twitter:image" content="https://franciscomadeira.com/og-pic.jpg">
        <meta name="twitter:title" content="Francisco Madeira">
        <meta name="twitter:description" content="All my given talks available online.">
        <meta name="description" content="All my given talks available online.">
    </Head>
    <h1 class="mt-6 text-center text-3xl sm:text-6xl font-bold tracking-tight">
        Given Talks
    </h1>

    <article
        v-for="post in posts"
        :key="post.id"
        class="article"
    >
        <h2 v-emoji class="subtitle">
            {{ post.title }}
        </h2>
        <Markdown>{{ post.text }}</Markdown>
    </article>
</template>

<script setup>
import Markdown from '@/js/Shared/Markdown.vue'

defineProps({
    posts: Object,
})
</script>
