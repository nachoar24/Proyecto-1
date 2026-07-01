<?php

use App\Models\User;
use App\Notifications\IdeaPublished;
use Illuminate\Support\Facades\Notification;

it('shows all ideas for the authenticated user', function () {
    $user = User::factory()->create();

    $user->ideas()->create([
        'description' => 'Build a thing',
        'state' => 'pending',
    ]);

    $response = $this->actingAs($user)->get('/ideas');

    $response->assertOk();
    $response->assertSee('Build a thing');
});

it('stores an idea and sends a notification', function () {
    Notification::fake();

    $user = User::factory()->create();

    $response = $this->actingAs($user)->post('/ideas', [
        'description' => 'Learn Pest testing',
    ]);

    $response->assertRedirect('/ideas');

    expect($user->ideas()
        ->where('description', 'Learn Pest testing')
        ->exists())->toBeTrue();

    Notification::assertSentTo($user, IdeaPublished::class);
});