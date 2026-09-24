<?php

return [
    'base_url' => env('FROZEN_UPDATE_BASE_URL', 'https://franciscomadeira.com/frozen'),
    'public_key' => env('FROZEN_PUBLIC_ED_KEY', 'QiuUjopUuq6ZgMlMFRKCnHfmXbRnlOT/9ViWVaeDlyk='),
    'publisher_token' => env('FROZEN_PUBLISHER_TOKEN'),
    'storage_disk' => env('FROZEN_STORAGE_DISK', 'frozen_releases'),
    'temporary_urls' => env('FROZEN_STORAGE_TEMPORARY_URLS', true),
    'temporary_url_minutes' => (int) env('FROZEN_STORAGE_URL_MINUTES', 5),
    'maximum_feed_items' => 3,
];
