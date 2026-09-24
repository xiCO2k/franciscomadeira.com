<?php

namespace App\Http\Controllers\Frozen;

use App\Models\FrozenFeed;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class FrozenAppcastController
{
    public function __invoke(Request $request): Response
    {
        $feed = FrozenFeed::query()->orderByDesc('published_at')->firstOrFail();

        $response = response($feed->xml, 200, [
            'Content-Type' => 'application/rss+xml; charset=utf-8',
            'Cache-Control' => 'public, max-age=300, must-revalidate',
            'X-Content-Type-Options' => 'nosniff',
        ]);
        $response->setEtag($feed->sha256);
        $response->setLastModified($feed->published_at);
        $response->isNotModified($request);

        return $response;
    }
}
