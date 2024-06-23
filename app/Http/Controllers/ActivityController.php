<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Services\ActivityService;
use App\Http\Requests\ActivityCreateRequest;
use App\Http\Requests\ActivityUpdateRequest;
use App\Http\Resources\SuccessResponseResource;

class ActivityController extends Controller
{
    private ActivityService $activityService;

    public function __construct(ActivityService $activityService)
    {
        $this->activityService = $activityService;
    }


    public function create(ActivityCreateRequest $request): Response
    {
        $payload = $request->validated();
        $rank = $this->activityService->save($payload);
        return created(__('messages.success.created'), $rank);
      
    }

    public function search(Request $request): Response
    {
        $filter = $request->only(['name', 'description']);
        $collection = $this->activityService->search($filter);
        return ok(__('messages.success.retrieve'), $collection);
    }

    public function update(ActivityUpdateRequest $request): Response
    {
        $payload = $request->validated();
        $saved = $this->activityService->update($payload);
        return ok(__('messages.success.updated'), $saved);
    }

    public function delete(?int $id = null): Response
    {
        validateId($id);
        validateExistenceDataById($id, $this->activityService);
        $this->activityService->delete($id);
        return ok(__('messages.success.deleted'));
    }

    public function detail(?int $id = null): Response
    {
        validateId($id);
        $institution = $this->activityService->findOne($id);
        return ok(__('messages.success.retrieve'), $institution);
    }
}
