<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta property="og:site_name" content="Francisco Madeira">
    {!! ssr($page, 'head') !!}
    <meta name="theme-color" content="#111827">
    <link rel="alternate" type="application/atom+xml" title="Francisco Madeira" href="{{ route('feed') }}">
    <link rel="icon" type="image/png" href="{{ asset('/favicon.png') }}" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preload" as="style" href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@400;700&display=swap">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@400;700&display=swap" rel="stylesheet">

    @vitedev
        <script type="module" src="http://localhost:3000/@vite/client"></script>
        <script type="module" src="http://localhost:3000/resources/js/app.js"></script>
        <script type="module" src="http://localhost:3000/resources/css/app.css"></script>
    @else
        <link rel="stylesheet" href="{{ vite('app.css') }}">
        <script type="module" src="{{ vite('app.js') }}" defer></script>
    @endvitedev

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
