<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Aschmelyun\BasicFeeds\Feed;

class FeedController extends Controller
{
    public function __invoke()
    {
        $feed = Feed::create([
            'link' => route('home'),
            'authors' => 'Francisco Madeira',
            'title' => 'Francisco Madeira Blog',
            'feed' => route('feed'),
        ]);

        Post::where('is_hidden', false)
            ->where('category', 'blog')
            ->orderByDesc('created_at')
            ->get()
            ->each(fn ($post) => $feed->entry([
                'title' => $post->title,
                'link' => route('post.detail', $post),
                'summary' => $post->description,
                'content' => preg_replace("/(```\w+)(,[^\s]+)/", '$1', $post->text),
            ]));

        return response($feed->asAtom())
            ->header('Content-Type', 'application/atom+xml');
    }
}
