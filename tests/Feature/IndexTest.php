<?php

use App\Models\Post;

it('shows all the posts', function () {
    $post = Post::factory()->create();

    $response = $this->get('/');

    $response
        ->assertOk()
        ->assertInertia(fn ($page) => $page
            ->component('Index')
            ->has('posts', 1, fn ($page) => $page
                ->where('title', $post->title)
                ->etc()
            ));
});
