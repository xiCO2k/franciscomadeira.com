<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Inertia\Inertia;
use Inertia\Response;
use Spatie\SchemaOrg\Schema;
use Spatie\SchemaOrg\WebSite;

class GivenTalksController
{
    public function __invoke(): Response
    {
        return Inertia::render('GivenTalks', [
            'posts' => Post::where('is_hidden', false)
                ->where('category', 'given-talks')
                ->get()
                ->map(fn ($post): array => [
                    'id' => $post->id,
                    'slug' => $post->slug,
                    'title' => $post->title,
                    'text' => $post->text,
                ]),
        ])->withViewData('schema', $this->getSchema());
    }

    private function getSchema(): WebSite
    {
        return Schema::webSite()
            ->url(route('given-talks'))
            ->mainEntityOfPage(Schema::webPage()->identifier(route('given-talks')))
            ->description('All my given talks available online.')
            ->publisher(Schema::organization()
                ->name('Francisco Madeira')
                ->logo(Schema::imageObject()
                    ->url('https://franciscomadeira.com.test/og-square.jpg')
                    ->width(Schema::quantitativeValue()->value(500))
                    ->height(Schema::quantitativeValue()->value(500))
                )
            );
    }
}
