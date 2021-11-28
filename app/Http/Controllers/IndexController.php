<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Inertia\Inertia;

class IndexController extends Controller
{
    public function __invoke()
    {
        $posts = Post::all();

        return Inertia::render('index', [
            'posts' => $posts
        ]);
    }
}
