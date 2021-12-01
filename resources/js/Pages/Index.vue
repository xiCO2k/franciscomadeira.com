<template>
    <MainHeader />
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
import MainHeader from '@/Shared/MainHeader'
import PostCard from '@/Shared/PostCard'

defineProps({ posts: Object })
</script>
