<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AuPair;
use App\Http\Requests\StoreAuPairRequest;
use App\Http\Resources\AuPairResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * AuPairController handles the business logic for Au Pair discovery and management.
 * It follows the JSON:API specification for resource modeling and utilizes 
 * Laravel's FormRequests for robust validation and API Resources for consistent data transformation.
 */
class AuPairController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        $query = AuPair::query();

        if ($request->has('min_age')) {
            $query->where('birth_date', '<=', now()->subYears($request->min_age));
        }

        if ($request->has('nationality')) {
            $query->where('nationality', $request->nationality);
        }

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        return AuPairResource::collection($query->paginate(15));
    }

    public function store(StoreAuPairRequest $request): AuPairResource
    {
        $auPair = AuPair::create($request->validated());
        return new AuPairResource($auPair);
    }

    public function show(AuPair $auPair): AuPairResource
    {
        return new AuPairResource($auPair);
    }

    public function update(StoreAuPairRequest $request, AuPair $auPair): AuPairResource
    {
        $auPair->update($request->validated());
        return new AuPairResource($auPair);
    }

    public function destroy(AuPair $auPair): \Illuminate\Http\JsonResponse
    {
        $auPair->delete();
        return response()->json(null, 204);
    }
}
