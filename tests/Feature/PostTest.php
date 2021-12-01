<?php

use App\Models\Post;

it('opens a post', function () {
    $post = Post::factory()->create();

    $response = $this->get(route('post.detail', $post));

    $response
        ->assertOk();
});

it('retuns a 404 if the post is not active', function () {
    $post = Post::factory()->create(['is_active' => false]);

    $response = $this->get(route('post.detail', $post));

    $response->assertNotFound();
});
