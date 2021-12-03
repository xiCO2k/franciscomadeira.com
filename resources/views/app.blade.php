<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta property="og:site_name" content="Francisco Madeira">
    <meta name="theme-color" content="#111827">
    <link rel="icon" type="image/png" href="{{ asset('/favicon.png') }}" />
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@400;700&display=swap" rel="stylesheet">
    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "WebSite",
            "publisher": {
                "@type": "Organization",
                "name": "Francisco Madeira",
                "logo": {
                    "@type": "ImageObject",
                    "url": "{{ asset('og-square.jpg') }}",
                    "width": 500,
                    "height": 500
                }
            },
            "url": "https://franciscomadeira.com",
            "mainEntityOfPage": {
                "@type": "WebPage",
                "@id": "https://franciscomadeira.com"
            },
            "description": "I'm Francisco Madeira - a Software Developer"
        }
    </script>
    <script src="{{ mix('/js/manifest.js') }}" defer></script>
    <script src="{{ mix('/js/vendor.js') }}" defer></script>
    <script src="{{ mix('/js/app.js') }}" defer></script>
    @routes

    @foreach(ssr($page, 'head') ?? [] as $element)
        {!! $element !!}
    @endforeach
</head>
<body>
    @if (ssr($page, 'body'))
        {!! ssr($page, 'body') !!}
    @else
        @inertia
    @endif
</body>
</html>
