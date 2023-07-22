<?php

namespace App\Http\Controllers\Platforms;

use Log;
use Throwable;
use App\Models\Platform;
use Illuminate\Http\Request;
use App\Services\PlatformService;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Exceptions\EntityInUseException;
use App\Http\Requests\Platforms\CreatePlatformRequest;
use App\Http\Requests\Platforms\UpdatePlatformRequest;

class PlatformController extends Controller
{
    public function __construct(
        protected readonly PlatformService $platformService,
    )
    {
        $this->authorizeResource(Platform::class, 'platform');
    }

    public function index(Request $request): View
    {
        return view('platforms.index', [
            'platforms' => $this->platformService->all($request->user()),
        ]);
    }

    public function create()
    {
        return view('platforms.form');
    }

    public function store(CreatePlatformRequest $request): RedirectResponse
    {
        try {
            $this->platformService->create($request->user(), $request->all());

            return redirect()
                ->route('platforms.index')
                ->with('success', "Platform \"{$request->get('name')}\" has been created.");
        } catch(Throwable $e) {
            Log::error($e);

            return redirect()
                ->back()
                ->withInput()
                ->withErrors([
                    'message' => 'Error occurred while creating the platform. Try again, or check the logs if this persists.',
                ]);
        }
    }

    public function show(Platform $platform): View
    {
        return view('platforms.show', [
            'platform' => $platform,
        ]);
    }

    public function edit(Platform $platform)
    {
        return view('platforms.form', [
            'platform' => $platform,
        ]);
    }

    public function update(UpdatePlatformRequest $request, Platform $platform): RedirectResponse
    {
        try {
            $this->platformService->update($platform, $request->all());

            return redirect()
                ->route('platforms.show', ['platform' => $platform])
                ->with('success', "Platform updated.");
        } catch(Throwable $e) {
            Log::error($e);

            return redirect()
                ->back()
                ->withInput()
                ->withErrors([
                    'message' => 'Error occurred while updating the platform. Try again, or check the logs if this persists.',
                ]);
        }
    }

    public function destroy(Request $request, Platform $platform): RedirectResponse
    {
        try {
            $this->platformService->delete($platform);

            return redirect()
                ->route('platforms.index')
                ->with('success', "Platform deleted.");
        } catch(EntityInUseException $e) {
            return redirect()
                ->back()
                ->withErrors([
                    'message' => 'This platform has games associated with it.',
                ]);
        } catch(Throwable $e) {
            Log::error($e);

            return redirect()
                ->back()
                ->withErrors([
                    'message' => 'Error occurred while deleting the platform. Try again, or check the logs if this persists.',
                ]);
        }
    }
}
