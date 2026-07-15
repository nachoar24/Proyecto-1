<?php

use App\Models\User;
use App\Notifications\EmailChanged;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;

it('requires authentication to edit a profile', function () {
    $this
        ->get(route('profile.edit'))
        ->assertRedirect(route('login'));
});

it('requires authentication to update a profile', function () {
    $this
        ->patch(route('profile.update'), [
            'name' => 'Usuario no autenticado',
            'email' => 'guest@example.com',
        ])
        ->assertRedirect(route('login'));
});

it('shows the current profile values', function () {
    $user = User::factory()->create([
        'name' => 'Nombre original',
        'email' => 'original@example.com',
    ]);

    $response = $this
        ->actingAs($user)
        ->get(route('profile.edit'));

    $response
        ->assertOk()
        ->assertSee(
            'data-test="edit-profile-form"',
            false
        )
        ->assertSee(
            'value="Nombre original"',
            false
        )
        ->assertSee(
            'value="original@example.com"',
            false
        )
        ->assertSee('Actualizar cuenta');
});

it('updates the authenticated user profile', function () {
    Notification::fake();

    $user = User::factory()->create([
        'name' => 'Nombre original',
        'email' => 'original@example.com',
        'password' => 'original-password',
    ]);

    $originalEmail = $user->email;
    $originalPassword = $user->password;

    $response = $this
        ->actingAs($user)
        ->patch(route('profile.update'), [
            'name' => 'Nombre actualizado',
            'email' => 'actualizado@example.com',
            'password' => '',
        ]);

    $response
        ->assertRedirect(route('profile.edit'))
        ->assertSessionHas(
            'success',
            'El perfil fue actualizado correctamente.'
        );

    $user->refresh();

    expect($user->name)
        ->toBe('Nombre actualizado')
        ->and($user->email)
        ->toBe('actualizado@example.com')
        ->and($user->password)
        ->toBe($originalPassword);

    Notification::assertSentOnDemand(
        EmailChanged::class,
        function (
            EmailChanged $notification,
            array $channels,
            object $notifiable
        ) use ($originalEmail, $user) {
            return in_array('mail', $channels, true)
                && $notifiable->routeNotificationFor('mail') === $originalEmail
                && $notification->user->is($user)
                && $notification->originalEmail === $originalEmail;
        }
    );
});

it('does not send a notification when the email is unchanged', function () {
    Notification::fake();

    $user = User::factory()->create([
        'name' => 'Nombre original',
        'email' => 'original@example.com',
    ]);

    $this
        ->actingAs($user)
        ->patch(route('profile.update'), [
            'name' => 'Nuevo nombre',
            'email' => 'original@example.com',
            'password' => '',
        ])
        ->assertRedirect(route('profile.edit'));

    Notification::assertNothingSent();
});

it('updates the password when a new password is provided', function () {
    $user = User::factory()->create([
        'email' => 'usuario@example.com',
        'password' => 'original-password',
    ]);

    $this
        ->actingAs($user)
        ->patch(route('profile.update'), [
            'name' => $user->name,
            'email' => $user->email,
            'password' => 'NewSecurePassword123!',
        ])
        ->assertRedirect(route('profile.edit'));

    expect(
        Hash::check(
            'NewSecurePassword123!',
            $user->refresh()->password
        )
    )->toBeTrue();
});

it('requires the email to be unique', function () {
    $user = User::factory()->create([
        'email' => 'usuario@example.com',
    ]);

    User::factory()->create([
        'email' => 'ocupado@example.com',
    ]);

    $response = $this
        ->actingAs($user)
        ->from(route('profile.edit'))
        ->patch(route('profile.update'), [
            'name' => $user->name,
            'email' => 'ocupado@example.com',
            'password' => '',
        ]);

    $response
        ->assertRedirect(route('profile.edit'))
        ->assertSessionHasErrors('email');

    expect($user->refresh()->email)
        ->toBe('usuario@example.com');
});

it('allows the user to keep their existing email', function () {
    $user = User::factory()->create([
        'email' => 'usuario@example.com',
    ]);

    $this
        ->actingAs($user)
        ->patch(route('profile.update'), [
            'name' => 'Nombre actualizado',
            'email' => 'usuario@example.com',
            'password' => '',
        ])
        ->assertRedirect(route('profile.edit'))
        ->assertSessionHasNoErrors();

    expect($user->refresh()->name)
        ->toBe('Nombre actualizado');
});
