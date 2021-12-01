<template>
    <article class="max-w-4xl mx-auto">
        <h1 class="font-bold text-3xl mb-4">
            {{ post.title }}
        </h1>
        <p class="text-white text-opacity-50">
            {{ post.description }}
        </p>
    </article>
</template>
<script setup>
defineProps({ post: Object })
</script>
