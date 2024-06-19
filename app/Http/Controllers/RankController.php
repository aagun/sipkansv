<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use App\Services\RankService;
use App\Http\Requests\RankCreateRequest;
use Illuminate\Http\Request;
use App\Http\Requests\RankUpdateRequest;

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

    public function search(Request $request): Response
    {
        $filter = $request->only(['name', 'description']);
        $collection = $this->rankService->search($filter);
        return ok(__('messages.success.retrieve'), $collection);
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
        $institution = $this->rankService->findOne($id);
        return ok(__('messages.success.retrieve'), $institution);
    }
}
