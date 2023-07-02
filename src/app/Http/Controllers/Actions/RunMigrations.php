<?php

namespace App\Http\Controllers\Actions;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;
use App\Http\Requests\RunMigrationsRequest;

class RunMigrations extends Controller
{
    public function __invoke(RunMigrationsRequest $request)
    {
        Artisan::call('migrate', ['--force' => true]);
        return response()->json();
    }
}
