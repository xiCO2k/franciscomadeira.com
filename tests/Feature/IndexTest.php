<?php

use App\Models\Post;

it('opens the page', function () {
    $response = $this->get('/');

    $response->assertOk();
});

it('shows all the posts', function () {
    $post = Post::factory()->create();

    $response = $this->get('/');

    $response->assertInertia(fn ($page) => $page
        ->component('Index')
        ->has('posts', 1, fn ($page) => $page
            ->where('title', $post->title)
            ->etc()
        ));
});
