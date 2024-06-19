<?php

namespace App\Http\Controllers;

use App\Services\EducationService;
use App\Http\Requests\EducationCreateRequest;
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
        return created(__('messages.success.created'), $saved);
    }

    public function update(EducationUpdateRequest $request): Response
    {
        $payload = $request->validated();
        $saved = $this->educationService->update($payload);
        return ok(__('messages.success.updated'), $saved);
    }

    public function search(Request $request): Response
    {
        $filter = $request->only(['name', 'description']);
        $collection = $this->educationService->search($filter);
        return ok(__('messages.success.retrieve'), $collection);
    }

    public function delete(?int $id = null): Response
    {
        if (!isset($id)) exceptionIdNotFound();
        validateExistenceDataById($id, $this->educationService);
        $this->educationService->delete($id);
        return ok(__('messages.success.deleted'));
    }

    public function detail(?int $id = null): Response
    {
        validateId($id);
        $education = $this->educationService->findOne($id);
        return ok(__('messages.success.retrieve'), $education);
    }
}
