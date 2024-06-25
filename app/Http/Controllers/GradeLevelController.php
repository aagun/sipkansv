<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use App\Services\GradeLevelService;
use App\Http\Requests\GradeLevelCreateRequest;
use App\Http\Requests\GradeLevelUpdateRequest;
use App\Http\Requests\PageableRequest;
use App\Http\Resources\GradeLevelResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

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
        $saved = $this->gradeLevelService->save($payload);
        return created(__('messages.success.created'), $saved);
    }

    public function search(PageableRequest $request): Response | ResourceCollection
    {
        $filter = $request->toArray();
        $collection = $this->gradeLevelService->search($filter);
        return ok(
            __('messages.success.retrieve'),
            $collection,
            GradeLevelResource::class,
            true
        );
    }

    public function update(GradeLevelUpdateRequest $request): Response
    {
        $payload = $request->validated();
        $this->gradeLevelService->update($payload);
        return ok(__('messages.success.updated'));
    }

    public function delete(?int $id = null): Response
    {
        validateId($id);
        validateExistenceDataById($id, $this->gradeLevelService);
        $this->gradeLevelService->delete($id);
        return ok(__('messages.success.deleted'));
    }

    public function detail(?int $id = null): Response
    {
        validateId($id);
        validateExistenceDataById($id, $this->gradeLevelService);
        $gradeLevel = $this->gradeLevelService->findOne($id);
        return ok(__('messages.success.retrieve'), $gradeLevel);
    }
}
