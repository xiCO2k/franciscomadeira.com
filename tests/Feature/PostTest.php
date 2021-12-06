<?php

use App\Models\Post;

it('opens a post', function () {
    $post = Post::factory()->create();

    $response = $this->get(route('post.detail', $post));

    $response
        ->assertOk()
        ->assertInertia(fn ($page) => $page
            ->component('Post')
            ->has('post', fn ($page) => $page
                ->where('title', $post->title)
                ->where('description', $post->description)
                ->etc()
            )
        );
});

it('retuns a 404 if the post is not active', function () {
    $post = Post::factory()->create(['is_active' => false]);

    $response = $this->get(route('post.detail', $post));

    $response->assertNotFound();
});

it('add post views when the page is loaded', function () {
    $post = Post::factory()->create();

    $response = $this->get(route('post.detail', $post));

    expect($post->views()->count())->toBe(1);
});
