<template>
    <Head title="Francisco Madeira">
        <meta property="og:title" content="Francisco Madeira">
        <meta property="og:description" content="I'm Francisco Madeira - a Software Developer">
        <meta property="og:type" content="website">
        <meta property="og:url" content="https://franciscomadeira.com/">
        <meta property="og:image" content="https://franciscomadeira.com/og-pic.jpg">
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:site" content="@xico2k">
        <meta name="twitter:image" content="https://franciscomadeira.com/og-pic.jpg">
        <meta name="twitter:title" content="Francisco Madeira">
        <meta name="twitter:description" content="I'm Francisco Madeira - a Software Developer">
        <meta name="description" content="I'm Francisco Madeira - a Software Developer">
    </Head>
    <HomeHeader />
    <section
        v-if="posts.length > 0"
        class="mt-8 mb-4 sm:mb-8 mx-4 sm:mx-0 pt-4 max-w-2xl space-y-4 border-t border-gray-800"
    >
        <PostCard
            v-for="post in posts"
            :key="post.id"
            :post="post"
        />
    </section>
</template>
<script setup>
import HomeHeader from '@/Shared/HomeHeader.vue'
import PostCard from '@/Shared/PostCard.vue'

defineProps({
    posts: Object,
    layout: null,
})
</script>
