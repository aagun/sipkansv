<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use App\Services\ObservationService;
use App\Http\Requests\ObservationUpdateRequest;
use App\Http\Requests\ObservationCreateRequest;
use App\Http\Requests\PageableRequest;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\ObservationResource;

class ObservationController extends Controller
{
    private ObservationService $observationService;

    public function __construct(ObservationService $observationService)
    {
        $this->observationService = $observationService;
    }


    public function create(ObservationCreateRequest $request): Response
    {
        $payload = $request->validated();
        $rank = $this->observationService->save($payload);
        return created(__('messages.success.created'), $rank);
    }

    public function search(PageableRequest $request): Response | ResourceCollection
    {
        $filter = $request->toArray();
        $collection = $this->observationService->search($filter);
        return ok(
            __('messages.success.retrieve'),
            $collection,
            ObservationResource::class,
            true
        );
    }

    public function update(ObservationUpdateRequest $request): Response
    {
        $payload = $request->validated();
        $saved = $this->observationService->update($payload);
        return ok(__('messages.success.updated'), $saved);
    }

    public function delete(?int $id = null): Response
    {
        validateId($id);
        validateExistenceDataById($id, $this->observationService);
        $this->observationService->delete($id);
        return ok(__('messages.success.deleted'));
    }

    public function detail(?int $id = null): Response
    {
        validateId($id);
        validateExistenceDataById($id, $this->observationService);
        $institution = $this->observationService->findOne($id);
        return ok(__('messages.success.retrieve'), $institution);
    }
}
