<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use App\Http\Requests\RecommendationCreateRequest;
use App\Http\Requests\RecommendationUpdateRequest;
use App\Services\RecommendationService;
use App\Http\Requests\PageableRequest;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\RecommendationResource;

class RecommendationController extends Controller
{
    private RecommendationService $recommendationService;

    public function __construct(RecommendationService $recommendationService)
    {
        $this->recommendationService = $recommendationService;
    }


    public function create(RecommendationCreateRequest $request): Response
    {
        $payload = $request->validated();
        $rank = $this->recommendationService->save($payload);
        return created(__('messages.success.created'), $rank);
    }

    public function search(PageableRequest $request): Response | ResourceCollection
    {
        $filter = $request->toArray();
        $collection = $this->recommendationService->search($filter);
        return ok(
            __('messages.success.retrieve'),
            $collection,
            RecommendationResource::class,
            true
        );
    }

    public function update(RecommendationUpdateRequest $request): Response
    {
        $payload = $request->validated();
        $saved = $this->recommendationService->update($payload);
        return ok(__('messages.success.updated'), $saved);
    }

    public function delete(?int $id = null): Response
    {
        validateId($id);
        validateExistenceDataById($id, $this->recommendationService);
        $this->recommendationService->delete($id);
        return ok(__('messages.success.deleted'));
    }

    public function detail(?int $id = null): Response
    {
        validateId($id);
        validateExistenceDataById($id, $this->recommendationService);
        $institution = $this->recommendationService->findOne($id);
        return ok(__('messages.success.retrieve'), $institution);
    }
}
