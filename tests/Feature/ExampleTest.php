<?php

test('the home page redirects to ideas', function () {
    $response = $this->get('/');

    $response->assertRedirect('/ideas');
});