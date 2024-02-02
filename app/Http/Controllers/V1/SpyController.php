<?php

namespace App\Http\Controllers\V1;

use App\Http\Requests\IndexSpyRequest;
use App\Http\Requests\StoreSpyRequest;
use App\Http\Resources\SpyResource;
use App\Models\Spy;
use Illuminate\Http\JsonResponse;
use Illuminate\Pagination\Paginator;
use Symfony\Component\HttpFoundation\Response;

class SpyController extends ApiController
{

    protected array $publicMethods = ['index', 'random'];

    /**
     * Display a listing of the resource.
     *
     * @param IndexSpyRequest $request
     * @return Paginator
     */
    public function index(IndexSpyRequest $request): Paginator
    {
        $query = (new Spy())->applyFilters($request->validated());

        return $query->simplePaginate()->withQueryString();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreSpyRequest $request
     * @return JsonResponse
     */
    public function store(StoreSpyRequest $request): JsonResponse
    {
        try {
            Spy::create($request->validated());
            return response()->json(['message' => 'Spy created successfully']);
        } catch (\Exception $exception) {
            return response()->json(['message' => 'Failed to create spy'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Display a random listing of the resource.
     *
     * @return SpyResource|JsonResponse
     */
    public function random(): SpyResource|JsonResponse
    {
        try {
            return new SpyResource(Spy::randomSpies(5)->get());
        } catch (\Exception $exception) {
            return response()->json(['message' => 'Failed to fetch random spies'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
