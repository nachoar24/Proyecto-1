<?php

use App\Enums\IdeaStatus;
use App\Models\Idea;
use App\Models\Step;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

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

    $response = $this
        ->actingAs($user)
        ->get(route('ideas.index', [
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

    $response = $this
        ->actingAs($user)
        ->get('/ideas?status=basura');

    $response->assertOk();
    $response->assertSee('Idea pendiente');
    $response->assertSee('Idea completada');
});

it('creates a new idea', function () {
    Storage::fake('public');

    $user = User::factory()->create();

    $title = 'Comprar una propiedad';
    $description = 'Analizar opciones de inversión inmobiliaria.';

    $links = [
        'https://laracasts.com',
        'https://laravel.com',
    ];

    $steps = [
        [
            'description' => 'Investigar opciones',
            'completed' => false,
        ],
        [
            'description' => 'Comparar alternativas',
            'completed' => false,
        ],
    ];

    $image = UploadedFile::fake()->image(
        'featured-image.jpg',
        600,
        400
    );

    $response = $this
        ->actingAs($user)
        ->post(route('ideas.store'), [
            'title' => $title,
            'description' => $description,
            'status' => IdeaStatus::Completed->value,
            'links' => $links,
            'steps' => $steps,
            'image' => $image,
        ]);

    $response
        ->assertRedirect(route('ideas.index'))
        ->assertSessionHas(
            'success',
            'La idea fue creada correctamente.'
        );

    $this->assertDatabaseHas('ideas', [
        'user_id' => $user->id,
        'title' => $title,
        'description' => $description,
        'status' => IdeaStatus::Completed->value,
    ]);

    $idea = $user->ideas()->first();

    expect($idea)
        ->not->toBeNull()
        ->and($idea->title)->toBe($title)
        ->and($idea->description)->toBe($description)
        ->and($idea->status)->toBe(IdeaStatus::Completed)
        ->and($idea->links->getArrayCopy())->toBe($links)
        ->and($idea->image_path)->not->toBeNull();

    expect(str_starts_with($idea->image_path, 'ideas/'))
        ->toBeTrue();

    Storage::disk('public')
        ->assertExists($idea->image_path);

    $idea->load('steps');

    expect($idea->steps)
        ->toHaveCount(2)
        ->and($idea->steps->pluck('description')->all())
        ->toBe([
            'Investigar opciones',
            'Comparar alternativas',
        ])
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

it('requires the uploaded image to be an image file', function () {
    Storage::fake('public');

    $user = User::factory()->create();

    $file = UploadedFile::fake()->create(
        'document.pdf',
        100,
        'application/pdf'
    );

    $response = $this
        ->actingAs($user)
        ->post(route('ideas.store'), [
            'title' => 'Idea con archivo inválido',
            'description' => 'Esta idea no debe guardar un PDF como imagen.',
            'status' => IdeaStatus::Pending->value,
            'image' => $file,
        ]);

    $response->assertSessionHasErrors('image');

    expect($user->ideas()->count())->toBe(0);
});

it('requires authentication to view an idea', function () {
    $idea = Idea::factory()->create();

    $this
        ->get(route('ideas.show', $idea))
        ->assertRedirect(route('login'));
});

it('prevents users from viewing ideas they did not create', function () {
    $user = User::factory()->create();

    $idea = Idea::factory()->create([
        'title' => 'Idea privada de otro usuario',
    ]);

    $this
        ->actingAs($user)
        ->get(route('ideas.show', $idea))
        ->assertForbidden();
});

it('allows users to view their own ideas', function () {
    $user = User::factory()->create();

    $idea = Idea::factory()
        ->for($user)
        ->create([
            'title' => 'Idea autorizada',
        ]);

    $this
        ->actingAs($user)
        ->get(route('ideas.show', $idea))
        ->assertOk()
        ->assertSee('Idea autorizada');
});

it('renders the edit idea modal with the existing idea values', function () {
    $user = User::factory()->create();

    $idea = Idea::factory()
        ->for($user)
        ->create([
            'title' => 'Idea que será editada',
            'description' => 'Descripción original de la idea.',
            'status' => IdeaStatus::InProgress,
            'links' => [
                'https://laravel.com',
            ],
        ]);

    $idea->steps()->create([
        'description' => 'Paso existente',
        'completed' => true,
    ]);

    $response = $this
        ->actingAs($user)
        ->get(route('ideas.show', $idea));

    $response
        ->assertOk()
        ->assertSee(
            'data-test="edit-idea-button"',
            false
        )
        ->assertSee(
            'data-test="edit-idea-form"',
            false
        )
        ->assertSee(
            'action="'.route('ideas.update', $idea, false).'"',
            false
        )
        ->assertSee(
            'value="Idea que será editada"',
            false
        )
        ->assertSee('Descripción original de la idea.')
        ->assertSee('Paso existente')
        ->assertSee('https://laravel.com')
        ->assertSee('Actualizar idea');
});

it('updates an existing idea', function () {
    Storage::fake('public');

    $user = User::factory()->create();

    $idea = Idea::factory()
        ->for($user)
        ->create([
            'title' => 'Título original',
            'description' => 'Descripción original.',
            'status' => IdeaStatus::Pending,
            'links' => [
                'https://example.com',
            ],
        ]);

    $idea->steps()->createMany([
        [
            'description' => 'Paso anterior eliminado',
            'completed' => false,
        ],
        [
            'description' => 'Otro paso anterior',
            'completed' => true,
        ],
    ]);

    $image = UploadedFile::fake()->image(
        'updated-featured-image.png',
        800,
        500
    );

    $response = $this
        ->actingAs($user)
        ->patch(route('ideas.update', $idea), [
            'title' => 'Título actualizado',
            'description' => 'Descripción actualizada de la idea.',
            'status' => IdeaStatus::Completed->value,
            'links' => [
                'https://laravel.com',
                'https://laracasts.com',
            ],
            'steps' => [
                [
                    'description' => 'Paso actualizado y completado',
                    'completed' => true,
                ],
                [
                    'description' => 'Paso nuevo pendiente',
                    'completed' => false,
                ],
            ],
            'image' => $image,
        ]);

    $response
        ->assertRedirect(route('ideas.show', $idea))
        ->assertSessionHas(
            'success',
            'La idea fue actualizada correctamente.'
        );

    $idea->refresh()->load('steps');

    expect($idea->title)
        ->toBe('Título actualizado')
        ->and($idea->description)
        ->toBe('Descripción actualizada de la idea.')
        ->and($idea->status)
        ->toBe(IdeaStatus::Completed)
        ->and($idea->links->getArrayCopy())
        ->toBe([
            'https://laravel.com',
            'https://laracasts.com',
        ])
        ->and($idea->image_path)
        ->not->toBeNull();

    Storage::disk('public')
        ->assertExists($idea->image_path);

    expect($idea->steps)
        ->toHaveCount(2)
        ->and($idea->steps->pluck('description')->all())
        ->toBe([
            'Paso actualizado y completado',
            'Paso nuevo pendiente',
        ])
        ->and($idea->steps->pluck('completed')->all())
        ->toBe([
            true,
            false,
        ]);

    $this->assertDatabaseMissing('steps', [
        'idea_id' => $idea->id,
        'description' => 'Paso anterior eliminado',
    ]);
});

it('prevents users from updating ideas they did not create', function () {
    $user = User::factory()->create();

    $idea = Idea::factory()->create([
        'title' => 'Idea de otro usuario',
    ]);

    $this
        ->actingAs($user)
        ->patch(route('ideas.update', $idea), [
            'title' => 'Intento de actualización',
            'description' => 'Esta actualización no debe permitirse.',
            'status' => IdeaStatus::Pending->value,
            'links' => [],
            'steps' => [],
        ])
        ->assertForbidden();

    expect($idea->refresh()->title)
        ->toBe('Idea de otro usuario');
});

it('prevents users from deleting ideas they did not create', function () {
    $user = User::factory()->create();

    $idea = Idea::factory()->create();

    $this
        ->actingAs($user)
        ->delete(route('ideas.destroy', $idea))
        ->assertForbidden();

    $this->assertDatabaseHas('ideas', [
        'id' => $idea->id,
    ]);
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

it('prevents users from toggling steps for ideas they did not create', function () {
    $user = User::factory()->create();

    $idea = Idea::factory()->create();

    $step = $idea->steps()->create([
        'description' => 'Paso privado',
        'completed' => false,
    ]);

    $this
        ->actingAs($user)
        ->from(route('ideas.index'))
        ->patch(route('steps.update', $step))
        ->assertForbidden();

    expect($step->refresh()->completed)->toBeFalse();
});
