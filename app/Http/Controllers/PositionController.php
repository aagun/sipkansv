<?php

namespace App\Http\Controllers;

use App\Services\PositionService;
use App\Http\Requests\PositionCreateRequest;
use App\Http\Resources\SuccessResponseResource;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\PositionUpdateRequest;

class PositionController extends Controller
{
    private PositionService $positionService;

    public function __construct(PositionService $positionService)
    {
        $this->positionService = $positionService;
    }

    public function create(PositionCreateRequest $request): Response
    {
        $payload = $request->validated();
        $saved = $this->positionService->save($payload);
        return response(
            new SuccessResponseResource($saved),
            Response::HTTP_CREATED
        );
    }

    public function update(PositionUpdateRequest $request): Response
    {
        $payload = $request->validated();
        $saved = $this->positionService->update($payload);
        return response(new SuccessResponseResource($saved));
    }
}
