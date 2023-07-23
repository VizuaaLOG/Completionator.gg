<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\Games\GameController;
use App\Http\Controllers\Platforms\PlatformController;
use App\Http\Controllers\Storefronts\StorefrontController;
use App\Http\Controllers\Games\DownloadableContentController;

Auth::routes();

Route::middleware('auth')->group(function() {
    Route::get('/', HomeController::class)->name('dashboard');

    Route::resource('games', GameController::class);
    Route::resource('games/{game}/downloadable_content', DownloadableContentController::class)->except(['index']);
    Route::resource('platforms', PlatformController::class);
    Route::resource('storefronts', StorefrontController::class);
    Route::resource('companies', CompanyController::class);
    Route::resource('genres', GenreController::class);
});
