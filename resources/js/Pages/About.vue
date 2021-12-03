<template>
    <Head title="About">
        <meta property="og:title" content="About - Francisco Madeira">
        <meta property="og:description" content="I'm Francisco Madeira, 32 years old, I've been working as a Sofware Developer since 2010. Everyday I get to work with PHP, MySQL, TypeScript, JavaScript, and I'm an HUGE fan of the Test-Driven Development principle, and I've been using it on all my projects.">
        <meta name="description" content="I'm Francisco Madeira, 32 years old, I've been working as a Sofware Developer since 2010. Everyday I get to work with PHP, MySQL, TypeScript, JavaScript, and I'm an HUGE fan of the Test-Driven Development principle, and I've been using it on all my projects.">
        <meta property="og:type" content="article">
        <meta property="og:url" content="https://franciscomadeira.com/about">
        <meta property="og:image" content="https://franciscomadeira.com/og-about.png">
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:site" content="@xico2k">
        <meta name="twitter:title" content="About - Francisco Madeira">
        <meta name="twitter:description" content="I'm Francisco Madeira, 32 years old, I've been working as a Sofware Developer since 2010. Everyday I get to work with PHP, MySQL, TypeScript, JavaScript and I'm an HUGE fan of the Test-Driven Development principle, and I've been using it on all my projects.">
        <meta name="twitter:image" content="https://franciscomadeira.com/og-about.png">
    </Head>
    <article class="max-w-4xl mt-4 mx-auto px-8 text-lg">
        <div class="text-center mb-4 sm:mb-8">
            <h1
                v-emoji
                class="text-2xl sm:text-6xl font-bold tracking-tight"
            >
                Hello World! 👋
            </h1>
        </div>
        <div class="text-base leading-6">
            <p>I'm <b>Francisco Madeira</b>, <b>{{ age('1989-08-25') }}</b> years old, I've been working as a Sofware Developer since <b>2010</b>. Everyday I get to work with <b>PHP, MySQL, TypeScript, JavaScript</b>, and I'm a HUGE fan of the <b>T</b>est-<b>D</b>riven <b>D</b>evelopment principle, and I've been using it on all my projects.</p>
            <p class="mt-8">
                I had the chance to work with a lot of web tools in the past such as <b>Zend, CodeIgniter, Symfony, CakePHP, AngularJS, Ionic</b>, you name it...
            </p>
            <p
                v-emoji
                class="mt-8"
            >
                Right now, I've been using the <b>⚡️ Laravel Framework</b> and <b>🐳 Docker</b> almost on every project. For the frontend side, I've been using <b>VueJS</b> or <b>React</b> depending on the project needs.
            </p>
            <p class="mt-8">
                Also, I've been contributing to the Open-Source, on various projects, mostly, <b>PHP</b> and <b>JS</b> Packages, it's all available on my <a
                    href="https://github.com/xiCO2k"
                    class="text-gray-200 hover:text-white border-b-2 border-blue-300"
                    rel="noreferrer"
                    target="_blank"
                >GitHub page</a>.
            </p>

            <p class="mt-8">
                There are some OSS Projects I'm working:
            </p>
            <ul class="mt-4">
                <li>
                    <a
                        href="https://github.com/nunomaduro/termwind"
                        class="text-gray-200 hover:text-white font-bold border-b-2 border-blue-300"
                        rel="noreferrer"
                        target="_blank"
                        v-emoji
                    >Termwind</a> 🍃: In short, it's like Tailwind CSS, but for the <b>PHP command-line applications</b>.
                </li>
                <li class="mt-4">
                    <a
                        href="https://github.com/xiCO2k/laravel-vue-i18n"
                        class="text-gray-200 hover:text-white font-bold border-b-2 border-blue-300"
                        rel="noreferrer"
                        target="_blank"
                    >laravel-vue-i18n</a>: Allows to connect your <b>Laravel Framework</b> translation files with <b>Vue3</b>.
                </li>
                <li class="mt-4">
                    <a
                        href="https://github.com/xiCO2k/multi-sort"
                        class="text-gray-200 hover:text-white font-bold border-b-2 border-blue-300"
                        rel="noreferrer"
                        target="_blank"
                    >MultiSort</a>: Allows you to sort a <b>multidimensional</b> array easily.
                </li>
            </ul>

            <p class="mt-8" v-emoji>Besides code, I'm also <b>Christian</b>, a <b>Guitar Player</b> and the boyfriend of <b>❤️ Inês</b>.</p>
        </div>
    </article>
</template>
<script setup>
import age from 'dob-to-age';
</script>
