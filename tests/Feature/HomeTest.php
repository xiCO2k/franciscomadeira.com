<?php

use App\Models\Post;

it('opens the page', function () {
    $response = $this->get(route('home'));

    $response->assertNotFound();
});

it('shows all the posts', function () {
    $post = Post::factory()->create();

    $response = $this->get(route('home'));

    $response->assertInertia(fn ($page) => $page
        ->component('Home')
        ->has('posts', 1, fn ($page) => $page
            ->where('title', $post->title)
            ->etc()
        ));
});
