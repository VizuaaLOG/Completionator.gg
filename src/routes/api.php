<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\SystemController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Games\GameController;
use App\Http\Controllers\InitialSetupController;
use App\Http\Controllers\Games\GameStatusController;
use App\Http\Controllers\Games\GamePriorityController;
use App\Http\Controllers\Games\GamePlatformController;
use App\Http\Controllers\Platforms\PlatformController;

Route::prefix('v1')->group(function () {
    Route::get('/system', [SystemController::class, 'index'])->name('system.index');

    Route::post('/initial-setup', [InitialSetupController::class, 'store'])->name('initial-setup.store');

    Route::middleware('auth')->group(function () {
        Route::controller(ProfileController::class)->group(function () {
            Route::get('/me', 'show')->name('me.show');
            Route::put('/me', 'update')->name('me.update');
        });

        Route::resource('users', UserController::class)->except(['create', 'edit']);

        Route::resource('game_statuses', GameStatusController::class)->only(['index', 'show']);
        Route::resource('game_priorities', GamePriorityController::class)->only(['index', 'show']);

        Route::resource('games', GameController::class)->except(['create', 'edit']);
        Route::resource('games/{game}/platforms', GamePlatformController::class)->except(['update', 'create', 'edit', 'show']);

        Route::resource('platforms', PlatformController::class)->except(['create', 'edit']);
    });
});
