<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Auth::routes();

Route::middleware('auth')->group(function() {
    Route::get('/', HomeController::class)->name('dashboard');

    Route::get('/games/create', [\App\Http\Controllers\Games\GameController::class, 'create'])->name('games.create');
    Route::get('/games/{game}', [\App\Http\Controllers\Games\GameController::class, 'show'])->name('games.show');

    Route::get('/platforms/create', [\App\Http\Controllers\Platforms\PlatformController::class, 'create'])->name('platforms.create');
    Route::get('/platforms/{platform}', [\App\Http\Controllers\Platforms\PlatformController::class, 'show'])->name('platforms.show');
});
