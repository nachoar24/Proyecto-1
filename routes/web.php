<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('ideas', [
        'ideas' => session()->get('ideas', []),
    ]);
});

Route::post('/ideas', function () {
    $idea = request('idea');

    session()->push('ideas', $idea);

    return redirect('/');
});

Route::get('/delete-ideas', function () {
    session()->forget('ideas');

    return redirect('/');
});

Route::view('/about', 'about');

Route::view('/contact', 'contact');