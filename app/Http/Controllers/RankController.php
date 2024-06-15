<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use App\Services\RankService;
use App\Http\Requests\RankCreateRequest;
use App\Http\Resources\SuccessResponseResource;

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
}