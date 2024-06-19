<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
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
        $saved = $this->gradeLevelService->save($payload);
        return created(__('messages.success.created'), $saved);
    }

    public function search(Request $request): Response
    {
        $filter = $request->only(['name', 'description']);
        $collection = $this->gradeLevelService->search($filter);
        return ok(__('messages.success.retrieve'), $collection);
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
        $gradeLevel = $this->gradeLevelService->findOne($id);
        return ok(__('messages.success.retrieve'), $gradeLevel);
    }
}
