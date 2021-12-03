<template>
    <footer class="px-8 my-12 w-full max-w-7xl text-xs text-white text-opacity-20 text-center">
        © {{ year }}. No tracking or ads.
    </footer>
</template>

<script setup>
const year = (new Date()).getFullYear()
</script>
