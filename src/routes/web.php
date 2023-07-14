<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Games\GameController;
use App\Http\Controllers\Platforms\PlatformController;

Auth::routes();

Route::middleware('auth')->group(function() {
    Route::get('/', HomeController::class)->name('dashboard');

    Route::resource('games', GameController::class);
    Route::resource('platforms', PlatformController::class);

    Route::get('/platforms/create', [\App\Http\Controllers\Platforms\PlatformController::class, 'create'])->name('platforms.create');
    Route::get('/platforms/{platform}', [\App\Http\Controllers\Platforms\PlatformController::class, 'show'])->name('platforms.show');
});
