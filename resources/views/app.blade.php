<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#111827">
    <link rel="icon" type="image/png" href="{{ asset('/favicon.png') }}" />
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">

    <meta name="referrer" content="no-referrer-when-downgrade" />
    <meta name="description" content="I'm Francisco Madeira - a Software Developer" />

    <meta property="og:site_name" content="Francisco Madeira" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="Francisco Madeira" />
    <meta property="og:description" content="I'm Francisco Madeira - a Software Developer" />
    <meta property="og:url" content="{{ route('home') }}" />
    <meta property="og:image" content="{{ asset('og-pic.jpg') }}" />
    <meta property="og:image:width" content="1200" />
    <meta property="og:image:height" content="628" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="Francisco Madeira" />
    <meta name="twitter:description" content="I'm Francisco Madeira - a Software Developer" />
    <meta name="twitter:url" content="{{ route('home') }}" />
    <meta name="twitter:image" content="{{ asset('og-pic.jpg') }}" />
    <meta name="twitter:site" content="@xico2k" />

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
            "url": "{{ route('home') }}",
            "mainEntityOfPage": {
                "@type": "WebPage",
                "@id": "{{ route('home') }}"
            },
            "description": "I'm Francisco Madeira - a Software Developer"
        }
    </script>
    <script src="{{ mix('/js/manifest.js') }}" defer></script>
    <script src="{{ mix('/js/vendor.js') }}" defer></script>
    <script src="{{ mix('/js/app.js') }}" defer></script>
    @routes
</head>
<body>
    @inertia
</body>
</html>
