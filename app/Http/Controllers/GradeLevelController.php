<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use App\Http\Resources\SuccessResponseResource;
use App\Services\GradeLevelService;
use App\Http\Requests\GradeLevelCreateRequest;
use Illuminate\Http\Request;
use App\Http\Requests\GradeLevelUpdateRequest;

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

    public function search(Request $request): Response
    {
        $filter = $request->only(['name', 'description']);
        $collection = $this->gradeLevelService->search($filter);
        return response(new SuccessResponseResource(
            $collection,
            null,
            __('messages.success.retrieve')
        ));
    }

    public function update(GradeLevelUpdateRequest $request): Response
    {
        $payload = $request->validated();
        $this->gradeLevelService->update($payload);
        return response(new SuccessResponseResource(
            null,
            null,
            __('messages.success.updated')
        ));
    }

    public function delete(int $id): Response
    {
        validateExistenceDataById($id, $this->gradeLevelService);
        $this->gradeLevelService->delete($id);
        return response(new SuccessResponseResource(
            null,
            null,
            __('messages.success.deleted')
        ));
    }
}