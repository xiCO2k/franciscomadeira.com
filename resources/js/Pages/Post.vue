<template>
    <SmallHeader />
    <article class="max-w-3xl mx-auto">
        <h1 class="font-bold text-3xl mb-4">{{ post.title }}</h1>
        <p class="text-white text-opacity-50">{{ post.description }}</p>
    </article>
</template>
<script setup>
import SmallHeader from '@/Shared/SmallHeader'
defineProps({ post: Object })
</script>
