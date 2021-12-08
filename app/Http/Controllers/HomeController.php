<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Inertia\Inertia;
use Inertia\Response;
use Spatie\SchemaOrg\Schema;

class HomeController extends Controller
{
    public function __invoke(): Response
    {
        return Inertia::render('Home', [
            'posts' => Post::where('is_hidden', false)->get(),
        ])->withViewData('schema', $this->getSchema());
    }

    private function getSchema()
    {
        return Schema::webSite()
            ->url(route('home'))
            ->mainEntityOfPage(Schema::webPage()->identifier(route('home')))
            ->description("I'm Francisco Madeira - a Software Developer")
            ->publisher(Schema::organization()
                ->name('Francisco Madeira')
                ->logo(Schema::imageObject()
                    ->url('http://franciscomadeira.com.test/og-square.jpg')
                    ->width(500)
                    ->height(500)
                )
            );
    }
}
