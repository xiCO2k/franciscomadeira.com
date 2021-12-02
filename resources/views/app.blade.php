<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#111827">
    <link rel="icon" type="image/png" href="{{ asset('/favicon.png') }}" />
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
    <meta name="referrer" content="no-referrer-when-downgrade" />
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
