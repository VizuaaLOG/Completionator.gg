<?php

namespace App\Http\Controllers\Platforms;

use App\Models\Platform;
use Illuminate\Http\Request;
use App\Services\PlatformService;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Platforms\CreatePlatformRequest;
use App\Http\Requests\Platforms\UpdatePlatformRequest;

class PlatformController extends Controller
{
    public function __construct(
        protected readonly PlatformService $platformService,
    )
    {
    }

    public function index(Request $request): View
    {
        return view('dashboard');
//        return $this->platformService->all();
    }

    public function create()
    {
        return view('platforms.form');
    }

    public function store(CreatePlatformRequest $request): RedirectResponse
    {
        $this->platformService->create($request->all());
        return redirect()->route('platforms.index');
    }

    public function show(Request $request): View
    {
        return view('platforms.show');
    }

    public function update(UpdatePlatformRequest $request, Platform $platform): RedirectResponse
    {
        $this->platformService->update($platform, $request->all());
        return redirect()->route('platforms.index');
    }

    public function destroy(Request $request, Platform $platform): RedirectResponse
    {
        $this->platformService->delete($platform);
        return redirect()->route('platforms.index');
    }
}
