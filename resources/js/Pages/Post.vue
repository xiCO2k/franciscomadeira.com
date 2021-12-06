<template>
    <Head :title="post.title">
        <meta property="og:title" :content="post.title">
        <meta name="twitter:title" :content="post.title">
        <meta name="description" :content="post.description">
        <meta property="og:description" :content="post.description">
        <meta name="twitter:description" :content="post.description">
        <meta property="og:type" content="article">
        <meta property="og:url" :content="route('post', post.slug)">
        <meta property="og:image" :content="post.share_img">
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:site" content="@xico2k">
        <meta name="twitter:image" :content="post.share_img">
    </Head>
    <article class="article">
        <h1 v-emoji>
            {{ post.title }}
        </h1>

        <img src="../../img/termwind-released-hero.webp" class="w-full max-w-2xl mx-auto">
        <div>
            <p>Termwind allows you to build unique and beautiful PHP command-line applications, using the Tailwind CSS API with an HTML Renderer. In short, it's like Tailwind CSS, but for the PHP command-line applications.</p>
            <p>Termwind was created by <a href="https://twitter.com/xiCO2k" rel="noreferrer" target="_blank">Francisco Madeira</a> and <a href="https://twitter.com/enunomaduro" rel="noreferrer" target="_blank">Nuno Maduro</a>, and after almost three months of development <b>Termwind v1.0 is available</b>, and you can start using on your projects.</p>

            <p>Checkout the repository on <a href="https://github.com/nunomaduro/termwind" rel="noreferrer" target="_blank">GitHub</a>!</p>

            <h3>Why?</h3>
            <p>One of many things that annoyed all the CLI developers was to add some margin before the content, just to have some breading room, without <b>Termwind</b> the only way was to add spaces before each line, now with <b>Termwind</b> you can just pass the class <span class="code">ml-2</span> and you will have <b>two spaces</b> on every line for that element, just like how we do for the browser.</p>
            <p><b>This example</b> shows how easy it is to create a beautiful CLI output, with a simple knowledge on <b>HTML</b> and <b>TailwindCSS</b>.</p>

            <picture class="block mt-6">
                <img src="../../img/termwind-released.webp" class="w-full max-w-2xl mx-auto">
            </picture>

            <CodeSnippet lang="php" line-numbers>
                {{ `use function Termwind/render;

render(<<<HTML
    <div class="m-1">
        <div class="w-full text-center bg-green-400 text-black">
            <b>Termwind</b> v1.0 Released!
        </div>
        <p class="w-full text-center">
            After almost three months of development <b>Termwind</b> v1.0 is live.
        </p>
    </div>
HTML);` }}
            </CodeSnippet>

            <h3 class="mt-12">
                Now, lets create an output just like <b>PEST</b>
            </h3>

            <p>For this example we will take advantage of the <b>Laravel Framework</b> <span class="code">Command</span> with a <span class="code">blade</span> view.</p>

            <picture class="block mt-6">
                <img src="../../img/pest-example.webp" class="w-full max-w-2xl mx-auto">
            </picture>

            <CodeSnippet
                name="TermwindReleasedCommand.php"
                lang="php"
                line-numbers
            >
                {{ `<?php

namespace App\\Console\\Commands;

use Illuminate\\Console\\Command;
use function Termwind\\render;

class TermwindReleasedCommand extends Command
{
    protected $signature = 'termwind:released';

    public function handle()
    {
        return render(view('termwind', [
            'files' => [[
                'name' => 'Tests\TermwidReleasedTest',
                'tests' => [[
                    'name' => 'it is ready to use!',
                ]],
            ]],
            'totalTests' => 1,
            'totalTime' => '0.20s',
        ]));
    }
}` }}
            </CodeSnippet>

            <CodeSnippet name="termwind.blade.php" lang="blade" line-numbers>
                {{ `<div class="mx-2 my-1">
    @foreach ($files as $file)
        <div>
            <span class="px-1 font-bold bg-green text-black">PASS</span>
            {{ $file['name'] \}\}
        </div>
        @foreach ($file['tests'] as $test)
            <div class="text-gray-400">
                <b class="text-green">✓</b> {{ $test['name'] \}\}
            </div>
        @endforeach
    @endforeach

    <div class="mt-1">
        <span class="w-8">Tests:</span>
        <b class="text-green">{{ $totalTests \}\} passed</b>
    </div>

    <div>
        <span class="w-8">Time:</span>
        <span>{{ $totalTime \}\}</span>
    </div>
</div>` }}
            </CodeSnippet>

            <p><b>What's next?</b> As v1.0 is ready to use on production. The future developments we will focus on improving our documentation and provide a lot more use case examples.</p>
            <p><b>Get involved!</b> This is a community project and we are always looking for people to <a href="https://github.com/nunomaduro/termwind" rel="noreferrer" target="_blank">contribute</a>.</p>

            <ul>
                <li>You can learn more about, on <a href="https://github.com/nunomaduro/termwind" rel="noreferrer" target="_blank">GitHub</a>.</li>
                <li>Follow us on Twitter: <a href="https://twitter.com/enunomaduro" rel="noreferrer" target="_blank">@nunomaduro</a>, <a href="https://twitter.com/xiCO2k" rel="noreferrer" target="_blank">@xiCO2k</a>.</li>
            </ul>

            <p v-emoji class="text-gray-400 leading-6">
                <small>As a joke I added to my Twitter Description "I built everything with HTML and CSS" and all of a sudden I start working on Termwind and the API is based around HTML and CSS classes. 😎</small>
            </p>
        </div>
    </article>
</template>
<script setup>
import CodeSnippet from '@/Shared/CodeSnippet'

defineProps({ post: Object })
</script>
