<script setup>
import Markdown from '@/Shared/Markdown.vue'

defineProps({ post: Object })
</script>

<template>
    <Head :title="post.title">
        <meta property="og:title" :content="post.title">
        <meta name="twitter:title" :content="post.title">
        <meta name="description" :content="post.description">
        <meta property="og:description" :content="post.description">
        <meta name="twitter:description" :content="post.description">
        <meta property="og:type" content="article">
        <meta property="og:url" :content="route('post.detail', post.slug)">
        <meta property="og:image" :content="post.share_img">
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:site" content="@xico2k">
        <meta name="twitter:image" :content="post.share_img">
    </Head>
    <article class="article">
        <h1 v-emoji>
            {{ post.title }}
        </h1>
        <Markdown>{{ post.text }}</Markdown>
    </article>
</template>
