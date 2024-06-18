<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use App\Http\Resources\SuccessResponseResource;
use App\Services\GradeLevelService;
use App\Http\Requests\GradeLevelCreateRequest;

class GradeLevelController extends Controller
{
    private GradeLevelService $gradeLevelService;
    public function __construct(GradeLevelService $gradeLevelService)
    {
        $this->gradeLevelService = $gradeLevelService;
    }


    public function create(GradeLevelCreateRequest $request): Response
    {
        $payload = $request->validated();
        $this->gradeLevelService->save($payload);
        return response(
            new SuccessResponseResource(null, null, __('messages.success.created')),
            Response::HTTP_CREATED
        );
    }
}
