<?php

namespace App\Http\Controllers;

use DB;
use Log;
use Throwable;
use App\Models\UserRole;
use App\Services\UserService;
use Illuminate\Http\Response;
use App\Services\SettingService;
use App\Http\Requests\InitialSetupRequest;

class InitialSetupController extends Controller
{
    public function __construct(
        protected readonly SettingService $settingService,
        protected readonly UserService    $userService,
    )
    {
    }

    public function store(InitialSetupRequest $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $this->settingService->set('system.instance_name', $request->input('system.instance_name'));
                $this->userService->create($request->input('admin'), UserRole::ADMIN);
                $this->settingService->set('system.setup.complete', true);
            });

            return response()->json();
        } catch (Throwable $e) {
            Log::error($e);

            return response()->json(status: Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}