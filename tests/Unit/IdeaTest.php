<?php

use App\Models\Idea;

it('formats a description using markdown', function () {
    $idea = new Idea([
        'description' => <<<'MARKDOWN'
# Solicitud de funcionalidad

Esta descripción contiene **texto importante** y un [enlace](https://laravel.com).

- Primer elemento
- Segundo elemento
MARKDOWN,
    ]);

    expect($idea->formatted_description)
        ->toContain('<h1>Solicitud de funcionalidad</h1>')
        ->toContain('<strong>texto importante</strong>')
        ->toContain('<a href="https://laravel.com">enlace</a>')
        ->toContain('<li>Primer elemento</li>')
        ->toContain('<li>Segundo elemento</li>');
});

it('strips raw html from markdown descriptions', function () {
    $idea = new Idea([
        'description' => 'Texto seguro <script>alert("XSS")</script>',
    ]);

    expect($idea->formatted_description)
        ->toContain('Texto seguro')
        ->not->toContain('<script>');
});
