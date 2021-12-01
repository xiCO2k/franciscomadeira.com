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
    <script src="{{ mix('/js/manifest.js') }}" defer></script>
    <script src="{{ mix('/js/vendor.js') }}" defer></script>
    <script src="{{ mix('/js/app.js') }}" defer></script>
    @routes
</head>
<body>
    @inertia
</body>
</html>
