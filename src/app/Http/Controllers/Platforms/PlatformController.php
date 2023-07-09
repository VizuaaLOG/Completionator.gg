<?php

namespace App\Http\Controllers\Platforms;

use Log;
use Throwable;
use App\Models\Platform;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Services\PlatformService;
use App\Http\Controllers\Controller;
use App\Http\Transformers\ExceptionTransformer;
use App\Http\Requests\Platforms\CreatePlatformRequest;
use App\Http\Requests\Platforms\UpdatePlatformRequest;
use App\Http\Transformers\Platforms\PlatformTransformer;

class PlatformController extends Controller
{
    public function __construct(
        protected readonly PlatformService $platformService,
    )
    {
    }

    public function index(Request $request): JsonResponse
    {
        return $this->fractalResponse(
            request: $request,
            data: $this->platformService->all(),
            transformer: new PlatformTransformer,
        );
    }

    public function create()
    {
        return view('platforms.form');
    }

    public function store(CreatePlatformRequest $request): JsonResponse
    {
        try {
            return $this->fractalResponse(
                request: $request,
                data: $this->platformService->create($request->all()),
                transformer: new PlatformTransformer,
                status: Response::HTTP_CREATED,
            );
        } catch(Throwable $e) {
            Log::error($e);
            return $this->fractalResponse(
                request: $request,
                data: $e,
                transformer: new ExceptionTransformer,
                status: Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    public function show(Request $request)
    {
        return view('platforms.show');
    }

    public function update(UpdatePlatformRequest $request, Platform $platform): JsonResponse
    {
        try {
            return $this->fractalResponse(
                request: $request,
                data: $this->platformService->update($platform, $request->all()),
                transformer: new PlatformTransformer,
                status: Response::HTTP_OK,
            );
        } catch(Throwable $e) {
            Log::error($e);
            return $this->fractalResponse(
                request: $request,
                data: $e,
                transformer: new ExceptionTransformer,
                status: Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    public function destroy(Request $request, Platform $platform): JsonResponse
    {
        try {
            $this->platformService->delete($platform);
            return response()->json();
        } catch (Throwable $e) {
            Log::error($e);
            return $this->fractalResponse(
                request: $request,
                data: $e,
                transformer: new ExceptionTransformer,
                status: Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}
