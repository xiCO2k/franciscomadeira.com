<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta property="og:site_name" content="Francisco Madeira">
    {!! ssr($page, 'head') !!}
    <meta name="theme-color" content="#111827">
    <link rel="icon" type="image/png" href="{{ asset('/favicon.png') }}" />
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preload" as="style" href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@400;700&display=swap">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@400;700&display=swap" rel="stylesheet">
    <script src="{{ mix('/js/manifest.js') }}" defer></script>
    <script src="{{ mix('/js/vendor.js') }}" defer></script>
    <script src="{{ mix('/js/app.js') }}" defer></script>
    {!! optional($schema ?? [])->toScript() !!}
    @routes
</head>
<body>
    @if (ssr($page, 'body'))
        {!! ssr($page, 'body') !!}
    @else
        @inertia
    @endif
</body>
</html>
