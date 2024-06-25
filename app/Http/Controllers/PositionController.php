<?php

namespace App\Http\Controllers;

use App\Services\PositionService;
use App\Http\Requests\PositionCreateRequest;
use Illuminate\Http\Response;
use App\Http\Requests\PositionUpdateRequest;
use App\Http\Requests\PageableRequest;
use App\Http\Resources\PositionResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

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
        return created(__('messages.success.created'), $saved);
    }

    public function update(PositionUpdateRequest $request): Response
    {
        $payload = $request->validated();
        $saved = $this->positionService->update($payload);
        return ok(__('messages.success.updated'), $saved);
    }

    public function search(PageableRequest $request): Response | ResourceCollection
    {
        $filter = $request->toArray();
        $collection = $this->positionService->search($filter);
        return ok(
            __('messages.success.retrieve'),
            $collection,
            PositionResource::class,
            true
        );
    }

    public function delete(?int $id = null): Response
    {
        validateId($id);
        validateExistenceDataById($id, $this->positionService);
        $this->positionService->delete($id);
        return ok(__('messages.success.deleted'));
    }

    public function detail(?int $id = null): Response
    {
        validateId($id);
        validateExistenceDataById($id, $this->positionService);
        $institution = $this->positionService->findOne($id);
        return ok(__('messages.success.retrieve'), $institution);
    }
}
