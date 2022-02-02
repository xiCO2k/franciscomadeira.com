<?php

use App\Models\Post;

it('opens the page', function () {
    $this->get(route('given-talks'))
        ->assertOk();
});

it('shows only the given-talks posts', function () {
    Post::factory(2)->create([
        'category' => 'given-talks'
    ]);
    Post::factory()->create();

    $response = $this->get(route('given-talks'));

    $response->assertInertia(fn ($page) =>
        $page->has('posts', 2)
    );
});
