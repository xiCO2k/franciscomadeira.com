<template>
    <Head title="Francisco Madeira" />
    <HomeHeader />
    <section
        v-if="posts.length > 0"
        class="mt-8 max-w-2xl mx-auto space-y-4 border-t border-gray-800 pt-4"
    >
        <PostCard
            v-for="post in posts"
            :key="post.id"
            :post="post"
        />
    </section>
</template>
<script setup>
import HomeHeader from '@/Shared/HomeHeader'
import PostCard from '@/Shared/PostCard'

defineProps({
    posts: Object,
    layout: null,
})
</script>
