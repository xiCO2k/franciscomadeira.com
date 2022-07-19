<?php

namespace App;

use Illuminate\Support\Facades\Cache;
use Symfony\Component\Process\Exception\ProcessTimedOutException;
use Symfony\Component\Process\Process;
use Tightenco\Ziggy\Ziggy;

final class Ssr
{
    /**
     * Registers this class as a singleton from the app.
     */
    public static function register(): void
    {
        app()->singleton(self::class, fn () => new static());
    }

    /**
     * Gets the static version for the page.
     *
     * @param  array<string, mixed>  $page
     * @return string|array<string, mixed>
     */
    public function get(array $page, string $item = null, bool $cachable = true): array|string
    {
        $key = md5((string) json_encode($page));
        $data = [];

        if ($cachable) {
            $data = Cache::get($key, []);

            if ($data === []) {
                Cache::add($key, $data = $this->exec($page));
            }
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
        if (! file_exists(base_path('bootstrap/ssr/ssr.js'))) {
            return [];
        }

        $page['props']['ziggy'] = array_merge((new Ziggy)->toArray(), [
            'location' => request()->url(),
        ]);

        $process = Process::fromShellCommandline(sprintf(
            "node %s '%s'", base_path('bootstrap/ssr/ssr.js'),
            str_replace("'", '\\u0027', (string) json_encode($page))
        ))->setTimeout(1);

        try {
            $process->run();
        } catch (ProcessTimedOutException $e) {

            // .
        }

        $output = $process->getOutput();

        return json_decode($output !== '' && $output !== false ? $output : '[]', true);
    }
}
