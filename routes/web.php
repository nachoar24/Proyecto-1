<?php

use App\Http\Controllers\IdeaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/ideas');
});

Route::get('/ideas', [IdeaController::class, 'index']);

Route::get('/ideas/create', [IdeaController::class, 'create']);

Route::post('/ideas', [IdeaController::class, 'store']);

Route::get('/ideas/{idea}', [IdeaController::class, 'show']);

Route::get('/ideas/{idea}/edit', [IdeaController::class, 'edit']);

Route::patch('/ideas/{idea}', [IdeaController::class, 'update']);

Route::delete('/ideas/{idea}', [IdeaController::class, 'destroy']);

Route::view('/about', 'about');

Route::view('/contact', 'contact');