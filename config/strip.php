<?php

return [
    'base_url' => env('STRIP_UPDATE_BASE_URL', 'https://franciscomadeira.com/strip'),
    'public_key' => env('STRIP_PUBLIC_ED_KEY', 'fO4uwXP2VaQBJS58DrIfYs3+fXYyaSwRTGBRUhuwXN4='),
    'publisher_token' => env('STRIP_PUBLISHER_TOKEN'),
    'storage_disk' => env('STRIP_STORAGE_DISK', 'strip_releases'),
    'temporary_urls' => env('STRIP_STORAGE_TEMPORARY_URLS', true),
    'temporary_url_minutes' => (int) env('STRIP_STORAGE_URL_MINUTES', 5),
    'maximum_feed_items' => 3,
];
