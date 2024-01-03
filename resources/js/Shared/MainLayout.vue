<script setup>
import MainHeader from './MainHeader.vue'
import MainFooter from './MainFooter.vue'
</script>

<template>
    <MainHeader />
    <div class="flex-1">
        <div class="w-screen md:w-auto">
            <slot />
        </div>
    </div>
    <MainFooter />
</template>
