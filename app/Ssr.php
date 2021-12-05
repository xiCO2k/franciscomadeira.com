<?php

namespace App;

use Illuminate\Support\Facades\Cache;

final class Ssr
{
    /**
     * Gets the static version for the page.
     *
     * @param array<string, mixed> $page
     * @return string|array<string, mixed>
     */
    public function get(array $page, string $item = null): array|string
    {
        $key = $page['url'] . $page['version'];

        $data = Cache::get($key);

        if (! $data) {
            Cache::add($key, $data = $this->exec($page));
        }

        return $item && array_key_exists($item, $data) ? $data[$item] : $data;
    }

    /**
     * Executes the node ssr script to get the static information for the page.
     *
     * @return array<string, mixed>
     */
    public function exec(array $page): array
    {
        $output = exec(sprintf("node %s '%s'", public_path('js/ssr.js'), str_replace("'", "’", json_encode($page))));
        return json_decode($output !== "" && $output !== false ? $output : '[]' , true);
    }
}