<?php

namespace App\Http\Controllers;

use App\Services\PositionService;
use App\Http\Requests\PositionCreateRequest;
use App\Http\Resources\SuccessResponseResource;
use Illuminate\Http\Response;
use App\Http\Requests\PositionUpdateRequest;
use Illuminate\Http\Request;

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
            new SuccessResponseResource($saved, null, __('messages.success.created')),
            Response::HTTP_CREATED
        );
    }

    public function update(PositionUpdateRequest $request): Response
    {
        $payload = $request->validated();
        $saved = $this->positionService->update($payload);
        return response(new SuccessResponseResource($saved, null, __('messages.success.updated')));
    }

    public function search(Request $request): Response
    {
        $filter = $request->only(['name', 'description']);
        $collection = $this->positionService->search($filter);
        return response(new SuccessResponseResource($collection, null, __('messages.success.retrieve')));
    }

    public function delete(int $id): Response
    {
        validateExistenceDataById($id, $this->positionService);
        $this->positionService->delete($id);
        return response(new SuccessResponseResource(null, null, __('messages.success.deleted')));
    }
}
