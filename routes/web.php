<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome', [
        'saludo' => 'Hola',
        'persona' => request('persona', 'mundo'),
    ]);
});

Route::view('/about', 'about');

Route::view('/contact', 'contact');