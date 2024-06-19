<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use App\Services\DepartmentService;
use App\Http\Requests\DepartmentCreateRequest;
use Illuminate\Http\Request;
use App\Http\Requests\DepartmentUpdateRequest;

class DepartmentController extends Controller
{
    private DepartmentService $departmentService;

    public function __construct(DepartmentService $departmentService)
    {
        $this->departmentService = $departmentService;
    }

    public function create(DepartmentCreateRequest $request): Response
    {
        $payload = $request->validated();
        $this->departmentService->save($payload);
        return created(__('messages.success.created'));
    }

    public function search(Request $request): Response
    {
        $filter = $request->only(['name', 'description']);
        $collection = $this->departmentService->search($filter);
        return ok(__('messages.success.retrieve'), $collection);
    }

    public function update(DepartmentUpdateRequest $request): Response
    {
        $payload = $request->validated();
        $this->departmentService->update($payload);
        return ok(__('messages.success.updated'));
    }

    public function delete(?int $id = null): Response
    {
        validateId($id);
        validateExistenceDataById($id, $this->departmentService);
        $this->departmentService->delete($id);
        return ok(__('messages.success.deleted'));
    }

    public function detail(?int $id = null): Response
    {
        validateId($id);
        $department = $this->departmentService->findOne($id);
        return ok(__('messages.success.retrieve'), $department);
    }
}
