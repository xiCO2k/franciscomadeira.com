<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Spatie\SchemaOrg\Schema;
use Spatie\SchemaOrg\Article;

class PostController extends Controller
{
    public function __invoke(Post $post): Response
    {
        $post->views()->create([
            'ip' => request()->ip(),
            'agent' => request()->header('User-Agent'),
        ]);

        return Inertia::render('Post', [
            'post' => $post,
        ])->withViewData('schema', $this->getSchema($post));
    }

    private function getSchema(Post $post): Article
    {
        return Schema::article()
            ->headline($post->title)
            ->description($post->description)
            ->url(route('post.detail', $post))
            ->datePublished($post->created_at ?? now())
            ->dateModified($post->updated_at ?? now())
            ->keywords($post->keywords ?? '')
            ->mainEntityOfPage(Schema::webPage()->identifier(route('home')))
            ->image(Schema::imageObject()
                ->url($post->share_img)
                ->width(Schema::quantitativeValue()->value(1200))
                ->height(Schema::quantitativeValue()->value(628))
            )
            ->author(Schema::person()
                ->name('Francisco Madeira')
                ->url(route('home'))
                ->sameAs(['https://twitter.com/xiCO2k'])
                ->image(Schema::imageObject()
                    ->url('https://franciscomadeira.com.test/og-square.jpg')
                    ->width(Schema::quantitativeValue()->value(500))
                    ->height(Schema::quantitativeValue()->value(500))
                )
            );
    }
}
