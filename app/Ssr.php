<?php

namespace App;

final class Ssr
{
    protected array $pages = [];

    public function get(array $page, string $item = null): array|string
    {
        $component = $page['component'];

        if (! array_key_exists($component, $this->pages)) {
            $this->pages[$component] = $this->exec($page);
        }

        return $item ? $this->pages[$component][$item] : $this->pages[$component];
    }

    public function exec(array $page): array
    {
        $output = exec(sprintf("node %s '%s'", public_path('js/ssr.js'), json_encode($page)));

        if ($output === false) {
            return [];
        }

        return json_decode($output, true);
    }
}
