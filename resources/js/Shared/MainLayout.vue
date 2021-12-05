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
import MainHeader from './MainHeader'
import MainFooter from './MainFooter'
</script>
