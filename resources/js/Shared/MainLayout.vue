<template>
    <MainHeader />
    <div class="flex-1">
        <div class="w-screen">
            <slot />
        </div>
    </div>
    <MainFooter />
</template>

<script setup>
import MainHeader from './MainHeader.vue'
import MainFooter from './MainFooter.vue'
</script>
