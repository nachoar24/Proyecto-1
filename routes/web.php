<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome', [
        'saludo' => 'Hola',
        'persona' => request('persona', 'mundo'),
        'tareas' => [
            'Revisar rutas de Laravel',
            'Practicar componentes Blade',
            'Documentar el avance del proyecto',
        ],
    ]);
});

Route::view('/about', 'about');

Route::view('/contact', 'contact');