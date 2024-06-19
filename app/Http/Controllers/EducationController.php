<?php

namespace App\Http\Controllers;

use App\Services\EducationService;
use App\Http\Requests\EducationCreateRequest;
use App\Http\Resources\SuccessResponseResource;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\EducationUpdateRequest;
use Illuminate\Http\Request;

class EducationController extends Controller
{
    private EducationService $educationService;

    public function __construct(EducationService $educationService)
    {
        $this->educationService = $educationService;
    }

    public function create(EducationCreateRequest $request): Response
    {
        $payload = $request->validated();
        $saved = $this->educationService->save($payload);
        return response(
            new SuccessResponseResource($saved),
            Response::HTTP_CREATED
        );
    }

    public function update(EducationUpdateRequest $request): Response
    {
        $payload = $request->validated();
        $saved = $this->educationService->update($payload);
        return response(new SuccessResponseResource($saved));
    }

    public function search(Request $request): Response
    {
        $filter = $request->only(['name', 'description']);
        $collection = $this->educationService->search($filter);
        return response(new SuccessResponseResource($collection));
    }
}
