<?php

use App\Ssr;

if (! function_exists('ssr')) {
    /**
     * Gets the static version for the page.
     *
     * @param  array<string, mixed>  $page
     * @return string|array<string, mixed>
     */
    function ssr(array $page, ?string $item = null): array|string
    {
        return app(Ssr::class)->get($page, $item);
    }
}
