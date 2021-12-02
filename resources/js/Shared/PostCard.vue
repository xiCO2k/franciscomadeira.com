<template>
    <article>
        <Link
            :href="route('post.detail', post)"
            class="flex flex-col bg-gray-900 hover:bg-gray-800 p-8 rounded-xl"
        >
            <h2 class="font-bold text-3xl mb-4">
                {{ post.title }}
            </h2>
            <p class="text-white text-opacity-50">
                {{ post.description }}
            </p>
            <div class="mt-4">
                <span>Read more</span>
            </div>
        </Link>
    </article>
</template>

<script setup>
defineProps({ post: Object })
</script>
