<?php

use App\Enums\IdeaStatus;
use App\Models\Idea;
use App\Models\Step;
use App\Models\User;

it('belongs to a user', function () {
    $idea = Idea::factory()->create();

    $idea->load('user');

    expect($idea->user)->toBeInstanceOf(User::class);
});

it('can have steps', function () {
    $idea = Idea::factory()->create();

    $idea->load('steps');

    expect($idea->steps)->toBeEmpty();

    $idea->steps()->create([
        'description' => 'Realizarlo',
    ]);

    $idea->refresh()->load('steps');

    expect($idea->steps)
        ->toHaveCount(1)
        ->and($idea->steps->first())
        ->toBeInstanceOf(Step::class)
        ->and($idea->steps->first()->completed)
        ->toBeFalse();
});

it('casts status and links', function () {
    $idea = Idea::factory()->create([
        'status' => IdeaStatus::InProgress,
        'links' => [
            'https://laravel.com',
        ],
    ]);

    $idea->refresh();

    expect($idea->status)
        ->toBe(IdeaStatus::InProgress)
        ->and($idea->status->label())
        ->toBe('En progreso')
        ->and($idea->links[0])
        ->toBe('https://laravel.com');
});

it('filters ideas by status', function () {
    $user = User::factory()->create();

    Idea::factory()->for($user)->create([
        'title' => 'Idea pendiente',
        'status' => IdeaStatus::Pending,
    ]);

    Idea::factory()->for($user)->create([
        'title' => 'Idea completada',
        'status' => IdeaStatus::Completed,
    ]);

    $response = $this->actingAs($user)->get(route('ideas.index', [
        'status' => IdeaStatus::Completed->value,
    ]));

    $response->assertOk();
    $response->assertSee('Idea completada');
    $response->assertDontSee('Idea pendiente');
});

it('ignores invalid status filters', function () {
    $user = User::factory()->create();

    Idea::factory()->for($user)->create([
        'title' => 'Idea pendiente',
        'status' => IdeaStatus::Pending,
    ]);

    Idea::factory()->for($user)->create([
        'title' => 'Idea completada',
        'status' => IdeaStatus::Completed,
    ]);

    $response = $this->actingAs($user)->get('/ideas?status=basura');

    $response->assertOk();
    $response->assertSee('Idea pendiente');
    $response->assertSee('Idea completada');
});