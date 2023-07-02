<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SystemController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Games\GameController;
use App\Http\Controllers\Actions\RunMigrations;
use App\Http\Controllers\InitialSetupController;
use App\Http\Controllers\Games\GameStatusController;
use App\Http\Controllers\Games\GamePriorityController;
use App\Http\Controllers\Platforms\PlatformController;
use App\Http\Controllers\Games\GamePlatformController;
use App\Http\Controllers\Actions\Auth\DeleteCurrentSession;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('v1')->group(function () {
    Route::get('/', fn() => 'hi');

    Route::get('/system', [SystemController::class, 'index']);
    Route::post('/system/migrate', RunMigrations::class);

    Route::post('/initial-setup', [InitialSetupController::class, 'store']);

    Route::post('/auth/token', [AuthController::class, 'authenticate'])->name('auth.token');

    Route::middleware('auth:sanctum')->group(function () {
        Route::delete('/auth/sessions/current', DeleteCurrentSession::class);

        Route::controller(ProfileController::class)->group(function () {
            Route::get('/me', 'show');
            Route::put('/me', 'update');
        });

        Route::resource('users', UserController::class)->except(['create', 'edit']);

        Route::resource('game_statuses', GameStatusController::class)->only(['index', 'show']);
        Route::resource('game_priorities', GamePriorityController::class)->only(['index', 'show']);

        Route::resource('games', GameController::class)->except(['create', 'edit']);
        Route::resource('games/{game}/platforms', GamePlatformController::class)->except(['update', 'create', 'edit', 'show']);

        Route::resource('platforms', PlatformController::class)->except(['create', 'edit']);
    });
});
