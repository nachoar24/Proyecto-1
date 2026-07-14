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

it('creates a new idea', function () {
    $user = User::factory()->create();

    $title = 'Comprar una propiedad';
    $description = 'Analizar opciones de inversión inmobiliaria.';

    $links = [
        'https://laracasts.com',
        'https://laravel.com',
    ];

    $steps = [
        'Investigar opciones',
        'Comparar alternativas',
    ];

    $response = $this
        ->actingAs($user)
        ->post(route('ideas.store'), [
            'title' => $title,
            'description' => $description,
            'status' => IdeaStatus::Completed->value,
            'links' => $links,
            'steps' => $steps,
        ]);

    $response
        ->assertRedirect(route('ideas.index'))
        ->assertSessionHas('success', 'La idea fue creada correctamente.');

    $this->assertDatabaseHas('ideas', [
        'user_id' => $user->id,
        'title' => $title,
        'description' => $description,
        'status' => IdeaStatus::Completed->value,
    ]);

    expect($user->ideas()->count())->toBe(1);

    $idea = $user->ideas()->first();

    expect($idea)
        ->not->toBeNull()
        ->and($idea->title)->toBe($title)
        ->and($idea->description)->toBe($description)
        ->and($idea->status)->toBe(IdeaStatus::Completed);

    expect($idea->links->getArrayCopy())->toBe($links);

    $idea->load('steps');

    expect($idea->steps)
        ->toHaveCount(2)
        ->and($idea->steps->pluck('description')->all())
        ->toBe($steps)
        ->and($idea->steps->pluck('completed')->all())
        ->toBe([false, false]);
});

it('requires a title when creating an idea', function () {
    $user = User::factory()->create();

    $response = $this
        ->actingAs($user)
        ->post(route('ideas.store'), [
            'title' => '',
            'description' => 'Descripción sin título.',
            'status' => IdeaStatus::Pending->value,
        ]);

    $response->assertSessionHasErrors('title');

    expect($user->ideas()->count())->toBe(0);
});

it('requires a valid status when creating an idea', function () {
    $user = User::factory()->create();

    $response = $this
        ->actingAs($user)
        ->post(route('ideas.store'), [
            'title' => 'Idea con estado inválido',
            'description' => 'Esta idea no debe guardarse.',
            'status' => 'invalid-status',
        ]);

    $response->assertSessionHasErrors('status');

    expect($user->ideas()->count())->toBe(0);
});

it('requires links to be valid urls when creating an idea', function () {
    $user = User::factory()->create();

    $response = $this
        ->actingAs($user)
        ->post(route('ideas.store'), [
            'title' => 'Idea con enlace inválido',
            'description' => 'Esta idea no debe guardarse con un enlace inválido.',
            'status' => IdeaStatus::Pending->value,
            'links' => [
                'not-a-valid-url',
            ],
        ]);

    $response->assertSessionHasErrors('links.0');

    expect($user->ideas()->count())->toBe(0);
});

it('toggles a step completion status', function () {
    $user = User::factory()->create();

    $idea = Idea::factory()
        ->for($user)
        ->create();

    $step = $idea->steps()->create([
        'description' => 'Investigar opciones',
        'completed' => false,
    ]);

    $this
        ->actingAs($user)
        ->from(route('ideas.show', $idea))
        ->patch(route('steps.update', $step))
        ->assertRedirect(route('ideas.show', $idea));

    expect($step->refresh()->completed)->toBeTrue();

    $this
        ->actingAs($user)
        ->from(route('ideas.show', $idea))
        ->patch(route('steps.update', $step))
        ->assertRedirect(route('ideas.show', $idea));

    expect($step->refresh()->completed)->toBeFalse();
});