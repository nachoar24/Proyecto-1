<?php

use App\Models\User;

it('registers a user', function () {
    $response = $this->post('/register', [
        'name' => 'Juan Pérez',
        'email' => 'juan@example.com',
        'password' => 'password123',
    ]);

    $response->assertRedirect('/ideas');
    $response->assertSessionHas('success', 'Tu cuenta fue creada correctamente.');

    $this->assertAuthenticated();

    $this->assertDatabaseHas('users', [
        'name' => 'Juan Pérez',
        'email' => 'juan@example.com',
    ]);
});

it('logs in a user', function () {
    $user = User::factory()->create([
        'email' => 'maria@example.com',
        'password' => 'password123',
    ]);

    $response = $this->post('/login', [
        'email' => 'maria@example.com',
        'password' => 'password123',
    ]);

    $response->assertRedirect();
    $response->assertSessionHas('success', 'Has iniciado sesión correctamente.');

    $this->assertAuthenticatedAs($user);
});

it('logs out a user', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->post('/logout');

    $response->assertRedirect();
    $response->assertSessionHas('success', 'Has cerrado sesión correctamente.');

    $this->assertGuest();
});

it('requires a valid email address when registering', function () {
    $response = $this->from('/register')->post('/register', [
        'name' => 'Juan Pérez',
        'email' => 'correo-no-valido',
        'password' => 'password123',
    ]);

    $response->assertRedirect('/register');
    $response->assertSessionHasErrors('email');

    $this->assertGuest();
});

it('does not log in with invalid credentials', function () {
    User::factory()->create([
        'email' => 'ana@example.com',
        'password' => 'password123',
    ]);

    $response = $this->from('/login')->post('/login', [
        'email' => 'ana@example.com',
        'password' => 'clave-incorrecta',
    ]);

    $response->assertRedirect('/login');
    $response->assertSessionHasErrors();

    $this->assertGuest();
});
