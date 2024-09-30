<script setup>
import MainFooter from "./MainFooter.vue";
import MainHeader from "./MainHeader.vue";
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
