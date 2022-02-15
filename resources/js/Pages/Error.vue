<template>
    <Head :title="title" />
    <h1 class="text-lg sm:text-2xl md:text-4xl lg:text-5xl font-bold text-center mt-8 mb-8">
        {{ title }}
    </h1>
    <div class="text-center">
        {{ description }}
    </div>
    <div class="mt-8 text-center">
        <Link :href="route('home')" class="link-underline">
            &larr; Go Back
        </Link>
    </div>
</template>

<script setup>
const props = defineProps({ status: Number });

const title = {
    503: '503: Service Unavailable',
    500: '500: Server Error',
    404: '404: Page Not Found',
    403: '403: Forbidden',
}[props.status];

const description = {
    503: 'Sorry, we are doing some maintenance. Please check back soon.',
    500: 'Whoops, something went wrong on our servers.',
    404: 'Sorry, the page you are looking for could not be found.',
    403: 'Sorry, you are forbidden from accessing this page.',
}[props.status];
</script>
