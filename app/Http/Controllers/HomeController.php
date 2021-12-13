<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Inertia\Inertia;
use Inertia\Response;
use Spatie\SchemaOrg\Schema;
use Spatie\SchemaOrg\WebSite;

class HomeController extends Controller
{
    public function __invoke(): Response
    {
        return Inertia::render('Home', [
            'posts' => Post::where('is_hidden', false)
                ->get()
                ->map(fn ($post) => [
                    'id' => $post->id,
                    'slug' => $post->slug,
                    'title' => $post->title,
                    'description' => $post->description,
                ]),
        ])->withViewData('schema', $this->getSchema());
    }

    private function getSchema(): WebSite
    {
        return Schema::webSite()
            ->url(route('home'))
            ->mainEntityOfPage(Schema::webPage()->identifier(route('home')))
            ->description("I'm Francisco Madeira - a Software Developer")
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
