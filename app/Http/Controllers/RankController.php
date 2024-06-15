<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use App\Services\RankService;
use App\Http\Requests\RankCreateRequest;
use App\Http\Resources\SuccessResponseResource;
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
        return response(
            new SuccessResponseResource($rank),
            Response::HTTP_CREATED
        );
    }

    public function search(Request $request): Response
    {
        $filter = $request->only(['name', 'description']);
        $collection = $this->rankService->search($filter);
        return response(new SuccessResponseResource($collection));
    }

    public function update(RankUpdateRequest $request): Response
    {
        $payload = $request->validated();
        $saved = $this->rankService->update($payload);
        return response(new SuccessResponseResource($saved));
    }
}
