<?php

namespace App\Http\Controllers\Storefronts;

use Log;
use Throwable;
use App\Models\Storefront;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Services\StorefrontService;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Exceptions\EntityInUseException;
use App\Http\Requests\Storefronts\CreateStorefrontRequest;
use App\Http\Requests\Storefronts\UpdateStorefrontRequest;

class StorefrontController extends Controller
{
    public function __construct(
        protected readonly StorefrontService $storefrontService,
    )
    {
        $this->authorizeResource(Storefront::class, 'storefront');
    }

    public function index(Request $request): View
    {
        return view('storefronts.index', [
            'storefronts' => $this->storefrontService->all($request->user(), ['games']),
        ]);
    }

    public function create()
    {
        return view('storefronts.form');
    }

    public function store(CreateStorefrontRequest $request): RedirectResponse
    {
        try {
            $this->storefrontService->create($request->user(), $request->all());

            return redirect()
                ->route('storefronts.index')
                ->with('success', "Storefront \"{$request->get('name')}\" has been created.");
        } catch(Throwable $e) {
            Log::error($e);

            return redirect()
                ->back()
                ->withInput()
                ->withErrors([
                    'message' => 'Error occurred while creating the storefront. Try again, or check the logs if this persists.',
                ]);
        }
    }

    public function show(Storefront $storefront): View
    {
        return view('storefronts.show', [
            'storefront' => $storefront,
        ]);
    }

    public function edit(Storefront $storefront)
    {
        return view('storefronts.form', [
            'storefront' => $storefront,
        ]);
    }

    public function update(UpdateStorefrontRequest $request, Storefront $storefront): RedirectResponse
    {
        try {
            $this->storefrontService->update($storefront, $request->all());

            return redirect()
                ->route('storefronts.show', ['storefront' => $storefront])
                ->with('success', "Storefront updated.");
        } catch(Throwable $e) {
            Log::error($e);

            return redirect()
                ->back()
                ->withInput()
                ->withErrors([
                    'message' => 'Error occurred while updating the storefront. Try again, or check the logs if this persists.',
                ]);
        }
    }

    public function destroy(Storefront $storefront): RedirectResponse
    {
        try {
            $this->storefrontService->delete($storefront);

            return redirect()
                ->route('storefronts.index')
                ->with('success', "Storefront deleted.");
        } catch(EntityInUseException) {
            return redirect()
                ->back()
                ->withErrors([
                    'message' => 'This storefront has games associated with it.',
                ]);
        } catch(Throwable $e) {
            Log::error($e);

            return redirect()
                ->back()
                ->withErrors([
                    'message' => 'Error occurred while deleting the storefront. Try again, or check the logs if this persists.',
                ]);
        }
    }
}
