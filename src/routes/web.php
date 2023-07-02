<?php

use Illuminate\Support\Facades\Route;

// We're using Vue for a SPA, so just let Vue handle it.
Route::fallback(fn() => view('base'));
