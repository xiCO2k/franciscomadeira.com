<?php

use App\Ssr;

if (! function_exists('ssr')) {
    function ssr(array $page, string $item = null): array|string
    {
        return app(Ssr::class)->get($page, $item);
    }
}
