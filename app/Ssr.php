<?php

namespace App;

use Illuminate\Support\Facades\Cache;

final class Ssr
{
    public function get(array $page, string $item = null): array|string
    {
        $key = $page['component'] . $page['version'];

        $data = Cache::get($key);

        if (! $data) {
            Cache::add($key, $data = $this->exec($page));
        }

        return $item ? $data[$item] : $data;
    }

    public function exec(array $page): array
    {
        $output = exec(sprintf("node %s '%s'", public_path('js/ssr.js'), json_encode($page)));

        return json_decode($output !== false ? $output : '[]' , true);
    }
}
