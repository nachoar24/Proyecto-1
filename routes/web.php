<?php

use Illuminate\Support\Facades\Route;


// Esta es la ruta por defecto
Route::get('/', function () {
    return view('welcome');
});


Route::get('/about', function () {
    return view('about');
});