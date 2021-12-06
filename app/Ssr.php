<?php

namespace App;

use Illuminate\Support\Facades\Cache;

final class Ssr
{
    /**
     * Registers this class as a singleton from the app.
     */
    public static function register()
    {
        app()->singleton(self::class, fn () => new static());
    }

    /**
     * Gets the static version for the page.
     *
     * @param array<string, mixed> $page
     *
     * @return string|array<string, mixed>
     */
    public function get(array $page, string $item = null): array|string
    {
        $key = $page['url'] . $page['version'];

        $data = Cache::get($key);

        if (! $data) {
            Cache::add($key, $data = $this->exec($page));
        }

        if ($item) {
            if (! array_key_exists($item, $data)) {
                return '';
            }

            return is_array($data[$item]) ? implode("\n", $data[$item]) : $data[$item];
        }

        return $data;
    }

    /**
     * Executes the node ssr script to get the static information for the page.
     *
     * @return array<string, mixed>
     */
    public function exec(array $page): array
    {
        if (! file_exists(public_path('js/ssr.js'))) {
            return [];
        }

        $output = exec(sprintf(
            "node %s '%s'", public_path('js/ssr.js'),
            str_replace("'", "\\u0027", (string) json_encode($page))
        ));

        return json_decode($output !== "" && $output !== false ? $output : '[]' , true);
    }
}
