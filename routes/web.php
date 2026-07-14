<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\SessionController;
use App\Http\Controllers\IdeaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StepController;

Route::get('/', function () {
    return redirect('/ideas');
})->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/ideas', [IdeaController::class, 'index'])
        ->name('ideas.index');

    Route::get('/ideas/create', [IdeaController::class, 'create'])
        ->name('ideas.create');

    Route::post('/ideas', [IdeaController::class, 'store'])
        ->name('ideas.store');

    Route::get('/ideas/{idea}', [IdeaController::class, 'show'])
        ->name('ideas.show');

    Route::get('/ideas/{idea}/edit', [IdeaController::class, 'edit'])
        ->name('ideas.edit');

    Route::patch('/ideas/{idea}', [IdeaController::class, 'update'])
        ->name('ideas.update');

    Route::delete('/ideas/{idea}', [IdeaController::class, 'destroy'])
        ->name('ideas.destroy');

    Route::patch('/steps/{step}', [StepController::class, 'update'])
        ->name('steps.update');

    Route::get('/admin', function () {
        return view('admin.index');
    })->can('view-admin');

    Route::post('/logout', [SessionController::class, 'destroy'])
        ->name('logout');
});

Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('/register', [RegisteredUserController::class, 'store']);

    Route::get('/login', [SessionController::class, 'create'])
        ->name('login');

    Route::post('/login', [SessionController::class, 'store']);
});

Route::view('/about', 'about');

Route::view('/contact', 'contact');
