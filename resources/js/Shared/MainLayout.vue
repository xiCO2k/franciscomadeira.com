<template>
    <MainHeader />
    <div class="flex-1">
        <slot />
    </div>
    <MainFooter />
</template>

<script setup>
import MainHeader from './MainHeader'
import MainFooter from './MainFooter'
</script>
