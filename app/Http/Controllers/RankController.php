<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use App\Services\RankService;
use App\Http\Requests\RankCreateRequest;
use App\Http\Requests\RankUpdateRequest;
use App\Http\Requests\PageableRequest;
use App\Http\Resources\RankResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class RankController extends Controller
{
    private RankService $rankService;

    public function __construct(RankService $rankService)
    {
        $this->rankService = $rankService;
    }


    public function create(RankCreateRequest $request): Response
    {
        $payload = $request->validated();
        $rank = $this->rankService->save($payload);
        return created(__('messages.success.created'), $rank);
    }

    public function search(PageableRequest $request): Response | ResourceCollection
    {
        $filter = $request->toArray();
        $collection = $this->rankService->search($filter);
        return ok(
            __('messages.success.retrieve'),
            $collection,
            RankResource::class,
            true
        );
    }

    public function update(RankUpdateRequest $request): Response
    {
        $payload = $request->validated();
        $saved = $this->rankService->update($payload);
        return ok(__('messages.success.updated'), $saved);
    }

    public function delete(?int $id = null): Response
    {
        validateId($id);
        validateExistenceDataById($id, $this->rankService);
        $this->rankService->delete($id);
        return ok(__('messages.success.deleted'));
    }

    public function detail(?int $id = null): Response
    {
        validateId($id);
        validateExistenceDataById($id, $this->rankService);
        $institution = $this->rankService->findOne($id);
        return ok(__('messages.success.retrieve'), $institution);
    }
}
