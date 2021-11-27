<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Francisco Madeira</title>
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">

    <meta name="referrer" content="no-referrer-when-downgrade" />
    <meta name="description" content="I'm Francisco Madeira - a Software Enginner" />

    <meta property="og:site_name" content="Francisco Madeira" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="Francisco Madeira" />
    <meta property="og:description" content="I'm Francisco Madeira - a Software Enginner" />
    <meta property="og:url" content="https://franciscomadeira.com/" />
    <meta property="og:image" content="https://franciscomadeira.com/og-pic.jpg" />
    <meta property="og:image:width" content="1200" />
    <meta property="og:image:height" content="628" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="Francisco Madeira" />
    <meta name="twitter:description" content="I'm Francisco Madeira - a Software Enginner" />
    <meta name="twitter:url" content="https://franciscomadeira.com/" />
    <meta name="twitter:image" content="https://franciscomadeira.com/og-pic.jpg" />
    <meta name="twitter:site" content="@xico2k" />

    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "WebSite",
            "publisher": {
                "@type": "Organization",
                "name": "Francisco Madeira",
                "logo": {
                    "@type": "ImageObject",
                    "url": "https://franciscomadeira.com/og-square.jpg",
                    "width": 500,
                    "height": 500
                }
            },
            "url": "https://franciscomadeira.com/",
            "mainEntityOfPage": {
                "@type": "WebPage",
                "@id": "https://franciscomadeira.com/"
            },
            "description": "I'm Francisco Madeira - a Software Enginner"
        }
    </script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@400;700&display=swap" rel="stylesheet">
</head>
<body class="bg-gray-900 p-8 text-white">
    <div id="app">
        <header class="flex flex-col items-center">
            <img src="/og-square.jpg" class="w-36 h-36 sm:w-48 sm:h-48 border-8 border-gray-800 rounded-full mb-8" alt="Francisco Madeira">
            <h1 class="text-3xl sm:text-6xl font-bold tracking-tight">Hello World! 👋</h1>
            <h2 class="mt-4 text-lg text-center sm:text-2xl tracking-tight">I'm <b>Francisco Madeira</b> <br class="sm:hidden"><span class="hidden sm:inline"> - </span>A Software Engineer</h2>
            <h3 class="mt-4 text-sm sm:text-base tracking-tight text-center">I build everything with HTML and CSS 👌</h3>
            <div class="mt-8">
                <a href="https://github.com/xico2k" class="underline mr-1 text-gray-400 hover:text-gray-100">Github</a>
                <a href="https://twitter.com/xico2k" class="underline ml-1 text-gray-400 hover:text-gray-100">Twitter</a>
            </div>
        </header>

        <section class="mt-8 max-w-2xl mx-auto space-y-4 border-t border-gray-800 pt-4">
            <article>
                <a href="#" class="flex flex-col bg-gray-900 hover:bg-gray-800 p-8 rounded-xl">
                    <h2 class="font-bold text-3xl mb-4">
                        🍃 Termwind v1.0 Released
                    </h2>
                    <p class="text-white text-opacity-50">After 400+ commits, 3 betas, and seven months, Termwind has finally reached its first stable public release…</p>
                    <div class="mt-4">
                        <span>Read more</span>
                    </div>
                </a>
            </article>
        </section>
    </div>
</body>
</html>
