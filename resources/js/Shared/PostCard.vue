<template>
    <article>
        <Link
            :href="route('post.detail', post)"
            class="flex flex-col bg-gray-900 hover:bg-gray-800 px-5 sm:px-8 py-6 sm:py-8 rounded-xl"
        >
            <h2 v-emoji class="font-bold text-lg sm:text-3xl mb-4">
                {{ post.title }}
            </h2>
            <p class="text-xs leading-6 sm:text-base sm:leading-8 text-white text-opacity-70">
                {{ post.description }}
            </p>
            <div class="mt-4 text-xs leading-6 sm:text-base sm:leading-8">
                <span>Read more</span>
            </div>
        </Link>
    </article>
</template>

<script setup>
defineProps({ post: Object })
</script>
