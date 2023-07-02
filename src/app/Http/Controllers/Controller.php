<?php

namespace App\Http\Controllers;

use League\Fractal\Manager;
use Illuminate\Http\Request;
use League\Fractal\Resource\Item;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use League\Fractal\TransformerAbstract;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use League\Fractal\Resource\Collection as FractalCollection;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected function fractalResponse(
        Request             $request,
        mixed               $data,
        TransformerAbstract $transformer,
        int                 $status = 200
    ): JsonResponse
    {
        $fractal = new Manager();
        if ($request->has('includes')) {
            $fractal->parseIncludes($request->get('includes') ?? []);
        }

        if ($data instanceof Collection) {
            return response()->json(
                data: $fractal->createData(new FractalCollection($data, $transformer))->toArray(),
                status: $status,
            );
        }

        if ($data instanceof LengthAwarePaginator) {
            $resource = (new FractalCollection($data->getCollection(), $transformer));
            $resource->setPaginator(new IlluminatePaginatorAdapter($data));

            return response()->json(
                data: $fractal->createData($resource)->toArray(),
                status: $status,
            );
        }

        return response()->json(
            data: $fractal->createData(new Item($data, $transformer))->toArray(),
            status: $status,
        );
    }

    protected function getPerPageCount(Request $request): int|null
    {
        $count = $request->get('count');
        if (is_null($count)) {
            return null;
        }

        if ($count < 0) {
            return config('pagination.default');
        }

        return min($count, config('pagination.max'));
    }
}
