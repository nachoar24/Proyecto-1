<?php

use App\Models\User;

it('registers a user', function () {
    $email = 'jane@example.com';

    $response = $this->post('/register', [
        'name' => 'Jane Doe',
        'email' => $email,
        'password' => 'password',
    ]);

    $response->assertRedirect('/ideas');

    $this->assertAuthenticated();

    expect(User::where('email', $email)->exists())->toBeTrue();
});