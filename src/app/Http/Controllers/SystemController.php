<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SettingService;
use Illuminate\Support\Facades\Schema;
use App\Http\Transformers\SystemTransformer;

class SystemController extends Controller
{
    public function __construct(
        protected readonly SettingService $settingService,
    )
    {
    }

    public function index(Request $request)
    {
        // If the settings table does not exist, then we know the state
        if (!Schema::hasTable('settings')) {
            return $this->fractalResponse(
                request: $request,
                data: [
                    'setup_complete' => false,
                    'instance_name'  => config('app.name'),
                ],
                transformer: new SystemTransformer(),
            );
        }

        return $this->fractalResponse(
            request: $request,
            data: [
                'setup_complete' => $this->settingService->get('system.setup.complete', false),
                'instance_name'  => $this->settingService->get('system.instance_name', config('app.name')),
            ],
            transformer: new SystemTransformer(),
        );
    }
}
