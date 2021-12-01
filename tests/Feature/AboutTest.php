<?php

it('opens the page', function () {
    $response = $this->get(route('about'));

    $response
        ->assertOk()
        ->assertInertia(
            fn ($page) => $page->component('About')
        );
});
